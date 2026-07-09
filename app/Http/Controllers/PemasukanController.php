<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Models\Sumberdana;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class PemasukanController extends Controller
{
    public function index(Request $request)
    {
        $pemasukans = Pemasukan::with(['sumberdana', 'user', 'approver'])
            ->when($request->user()->role !== 'admin', function ($query) use ($request) {
                $query->where('user_id', $request->user()->id);
            })
            ->when($request->status, fn($query, $status) => $query->where('status', $status))
            ->when($request->search, function ($query, $search) {
                $query->whereHas('sumberdana', function ($q) use ($search) {
                    $q->where('nm_skpd', 'like', "%{$search}%")
                        ->orWhere('nm_rek', 'like', "%{$search}%");
                })->orWhere('keterangan', 'like', "%{$search}%");
            })
            ->latest('tanggal')
            ->paginate(15)
            ->withQueryString();

        return view('admin.Pemasukan.index', compact('pemasukans'));
    }

    public function create()
    {
        $sumberdanas = Sumberdana::when(Auth::user()->role !== 'admin', function ($q) {
            $q->where('kd_skpd', Auth::user()->skpd);
        })->orderBy('nm_skpd')->get();
        return view('admin.Pemasukan.create', compact('sumberdanas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sumberdana_id' => ['required', 'exists:sumberdana,id'],
            'tanggal'       => ['required', 'date'],
            'jumlah'        => ['required', 'numeric', 'min:0'],
            'keterangan'    => ['nullable', 'string', 'max:500'],
        ]);

        $validated['user_id'] = Auth::id();
        $validated['status'] = Pemasukan::STATUS_PENDING;

        Pemasukan::create($validated);

        $route = Auth::user()->role === 'admin' ? 'admin.pemasukan.index' : 'user.pemasukan.index';
        return redirect()
            ->route($route)
            ->with('success', 'Permintaan pemasukan berhasil diajukan.');
    }

    public function show(Pemasukan $pemasukan)
    {
        $pemasukan->load(['sumberdana', 'user', 'approver']);
        return view('admin.Pemasukan.show', compact('pemasukan'));
    }

    public function edit(Pemasukan $pemasukan)
    {
        abort_unless($pemasukan->status === Pemasukan::STATUS_PENDING, 403, 'Hanya permintaan berstatus pending yang dapat diubah.');
        abort_unless($pemasukan->user_id === Auth::id(), 403);

        $sumberdanas = Sumberdana::when(Auth::user()->role !== 'admin', function ($q) {
            $q->where('kd_skpd', Auth::user()->skpd);
        })->orderBy('nm_skpd')->get();
        return view('admin.Pemasukan.edit', compact('pemasukan', 'sumberdanas'));
    }

    public function update(Request $request, Pemasukan $pemasukan)
    {
        abort_unless($pemasukan->status === Pemasukan::STATUS_PENDING, 403, 'Hanya permintaan berstatus pending yang dapat diubah.');
        abort_unless($pemasukan->user_id === Auth::id(), 403);

        $validated = $request->validate([
            'sumberdana_id' => ['required', 'exists:sumberdana,id'],
            'tanggal'       => ['required', 'date'],
            'jumlah'        => ['required', 'numeric', 'min:0'],
            'keterangan'    => ['nullable', 'string', 'max:500'],
        ]);

        $pemasukan->update($validated);

        $route = Auth::user()->role === 'admin' ? 'admin.pemasukan.index' : 'user.pemasukan.index';
        return redirect()
            ->route($route)
            ->with('success', 'Permintaan pemasukan berhasil diperbarui.');
    }

    public function destroy(Pemasukan $pemasukan)
    {
        abort_unless($pemasukan->status === Pemasukan::STATUS_PENDING, 403, 'Hanya permintaan berstatus pending yang dapat dihapus.');
        abort_unless($pemasukan->user_id === Auth::id(), 403);

        $pemasukan->delete();

        $route = Auth::user()->role === 'admin' ? 'admin.pemasukan.index' : 'user.pemasukan.index';
        return redirect()
            ->route($route)
            ->with('success', 'Permintaan pemasukan berhasil dihapus.');
    }

    public function approve(Pemasukan $pemasukan)
    {
        abort_unless(Auth::user()->role === 'admin', 403);

        $now = now();

        switch ($pemasukan->status) {
            case Pemasukan::STATUS_PENDING:
                $pemasukan->update([
                    'status'      => Pemasukan::STATUS_APPROVED_1,
                    'approved_by' => Auth::id(),
                    'approved_at' => $now,
                    'rejection_reason' => null,
                ]);
                $msg = 'Pemasukan disetujui (Lv.1). Pengaju sekarang dapat mengunggah dokumen pendukung.';
                break;

            case Pemasukan::STATUS_DOCS_1_UPLOADED:
                $pemasukan->update([
                    'status'      => Pemasukan::STATUS_APPROVED_2,
                    'approved_by' => Auth::id(),
                    'approved_at' => $now,
                    'rejection_reason' => null,
                ]);
                $msg = 'Dokumen pendukung disetujui. Pengaju sekarang dapat mengunggah dokumen lanjutan.';
                break;

            case Pemasukan::STATUS_DOCS_2_UPLOADED:
                $sumberdana = $pemasukan->sumberdana;
                if ($sumberdana->pagu < $pemasukan->jumlah) {
                    return redirect()
                        ->route('admin.pemasukan.index')
                        ->with('error', 'Pagu sumber dana tidak mencukupi.');
                }

                $pemasukan->update([
                    'status'      => Pemasukan::STATUS_COMPLETED,
                    'approved_by' => Auth::id(),
                    'approved_at' => $now,
                    'rejection_reason' => null,
                ]);

                $sumberdana->decrement('pagu', $pemasukan->jumlah);
                $msg = 'Pemasukan selesai. Dana telah dikurangkan dari pagu sumber dana.';
                break;

            default:
                return redirect()
                    ->route('admin.pemasukan.index')
                    ->with('error', 'Status tidak valid untuk disetujui.');
        }

        return redirect()
            ->route('admin.pemasukan.index')
            ->with('success', $msg);
    }

    public function reject(Request $request, Pemasukan $pemasukan)
    {
        abort_unless(Auth::user()->role === 'admin', 403);

        $validated = $request->validate([
            'rejection_reason' => ['required', 'string', 'max:500'],
        ]);

        $pemasukan->update([
            'status'            => Pemasukan::STATUS_REJECTED,
            'approved_by'       => Auth::id(),
            'approved_at'       => now(),
            'rejection_reason'  => $validated['rejection_reason'],
        ]);

        return redirect()
            ->route('admin.pemasukan.index')
            ->with('success', 'Pemasukan ditolak.');
    }

    public function uploadDocument(Request $request, Pemasukan $pemasukan)
    {
        abort_unless($pemasukan->user_id === Auth::id(), 403);

        $validStatuses = [Pemasukan::STATUS_APPROVED_1, Pemasukan::STATUS_APPROVED_2];
        abort_unless(in_array($pemasukan->status, $validStatuses), 403, 'Tidak dapat mengunggah dokumen pada status ini.');

        $stage = $pemasukan->status === Pemasukan::STATUS_APPROVED_1 ? 1 : 2;

        $validated = $request->validate([
            'document' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png,doc,docx', 'max:5120'],
        ]);

        $file = $request->file('document');
        $filename = 'pemasukan_' . $pemasukan->id . '_doc' . $stage . '_' . time() . '.' . $file->extension();
        $path = $file->storeAs('documents/pemasukan', $filename, 'public');

        $updateData = [
            'document_' . $stage . '_name' => $file->getClientOriginalName(),
            'document_' . $stage . '_path' => $path,
        ];

        if ($stage === 1) {
            $updateData['status'] = Pemasukan::STATUS_DOCS_1_UPLOADED;
        } else {
            $updateData['status'] = Pemasukan::STATUS_DOCS_2_UPLOADED;
        }

        $pemasukan->update($updateData);

        $route = Auth::user()->role === 'admin' ? 'admin.pemasukan.index' : 'user.pemasukan.index';
        return redirect()
            ->route($route)
            ->with('success', 'Dokumen berhasil diunggah.');
    }

    public function downloadDocument(Pemasukan $pemasukan, $stage)
    {
        abort_unless(in_array($stage, [1, 2]), 404);

        $pathField = 'document_' . $stage . '_path';
        $nameField = 'document_' . $stage . '_name';

        abort_unless($pemasukan->$pathField, 404, 'Dokumen tidak ditemukan.');

        if (Auth::user()->role !== 'admin' && $pemasukan->user_id !== Auth::id()) {
            abort(403);
        }

        return Storage::disk('public')->download($pemasukan->$pathField, $pemasukan->$nameField);
    }

    public function exportPdf()
    {
        $pemasukans = Pemasukan::with(['sumberdana', 'user'])
            ->latest('tanggal')
            ->get();

        $pdf = Pdf::loadView('admin.Pemasukan.export-pdf', compact('pemasukans'));
        return $pdf->download('laporan-pemasukan-' . now()->format('Y-m-d') . '.pdf');
    }

    public function exportExcel()
    {
        $pemasukans = Pemasukan::with(['sumberdana', 'user'])
            ->latest('tanggal')
            ->get();

        return Excel::download(new \App\Exports\PemasukanExport($pemasukans), 'laporan-pemasukan-' . now()->format('Y-m-d') . '.xlsx');
    }
}
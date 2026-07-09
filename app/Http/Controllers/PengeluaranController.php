<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use App\Models\Sumberdana;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class PengeluaranController extends Controller
{
    public function index(Request $request)
    {
        $pengeluarans = Pengeluaran::with(['sumberdana', 'user', 'approver'])
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

        return view('admin.Pengeluaran.index', compact('pengeluarans'));
    }

    public function create()
    {
        $sumberdanas = Sumberdana::when(Auth::user()->role !== 'admin', function ($q) {
            $q->where('kd_skpd', Auth::user()->skpd);
        })->orderBy('nm_skpd')->get();
        return view('admin.Pengeluaran.create', compact('sumberdanas'));
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
        $validated['status'] = Pengeluaran::STATUS_PENDING;

        Pengeluaran::create($validated);

        $route = Auth::user()->role === 'admin' ? 'admin.pengeluaran.index' : 'user.pengeluaran.index';
        return redirect()
            ->route($route)
            ->with('success', 'Permintaan pengeluaran berhasil diajukan.');
    }

    public function show(Pengeluaran $pengeluaran)
    {
        $pengeluaran->load(['sumberdana', 'user', 'approver']);
        return view('admin.Pengeluaran.show', compact('pengeluaran'));
    }

    public function edit(Pengeluaran $pengeluaran)
    {
        abort_unless($pengeluaran->status === Pengeluaran::STATUS_PENDING, 403, 'Hanya permintaan berstatus pending yang dapat diubah.');
        abort_unless($pengeluaran->user_id === Auth::id(), 403);

        $sumberdanas = Sumberdana::when(Auth::user()->role !== 'admin', function ($q) {
            $q->where('kd_skpd', Auth::user()->skpd);
        })->orderBy('nm_skpd')->get();
        return view('admin.Pengeluaran.edit', compact('pengeluaran', 'sumberdanas'));
    }

    public function update(Request $request, Pengeluaran $pengeluaran)
    {
        abort_unless($pengeluaran->status === Pengeluaran::STATUS_PENDING, 403, 'Hanya permintaan berstatus pending yang dapat diubah.');
        abort_unless($pengeluaran->user_id === Auth::id(), 403);

        $validated = $request->validate([
            'sumberdana_id' => ['required', 'exists:sumberdana,id'],
            'tanggal'       => ['required', 'date'],
            'jumlah'        => ['required', 'numeric', 'min:0'],
            'keterangan'    => ['nullable', 'string', 'max:500'],
        ]);

        $pengeluaran->update($validated);

        $route = Auth::user()->role === 'admin' ? 'admin.pengeluaran.index' : 'user.pengeluaran.index';
        return redirect()
            ->route($route)
            ->with('success', 'Permintaan pengeluaran berhasil diperbarui.');
    }

    public function destroy(Pengeluaran $pengeluaran)
    {
        abort_unless($pengeluaran->status === Pengeluaran::STATUS_PENDING, 403, 'Hanya permintaan berstatus pending yang dapat dihapus.');
        abort_unless($pengeluaran->user_id === Auth::id(), 403);

        $pengeluaran->delete();

        $route = Auth::user()->role === 'admin' ? 'admin.pengeluaran.index' : 'user.pengeluaran.index';
        return redirect()
            ->route($route)
            ->with('success', 'Permintaan pengeluaran berhasil dihapus.');
    }

    public function approve(Pengeluaran $pengeluaran)
    {
        abort_unless(Auth::user()->role === 'admin', 403);

        $now = now();

        switch ($pengeluaran->status) {
            case Pengeluaran::STATUS_PENDING:
                $pengeluaran->update([
                    'status'      => Pengeluaran::STATUS_APPROVED_1,
                    'approved_by' => Auth::id(),
                    'approved_at' => $now,
                    'rejection_reason' => null,
                ]);
                $msg = 'Pengeluaran disetujui (Lv.1). Pengaju sekarang dapat mengunggah dokumen pendukung.';
                break;

            case Pengeluaran::STATUS_DOCS_1_UPLOADED:
                $pengeluaran->update([
                    'status'      => Pengeluaran::STATUS_APPROVED_2,
                    'approved_by' => Auth::id(),
                    'approved_at' => $now,
                    'rejection_reason' => null,
                ]);
                $msg = 'Dokumen pendukung disetujui. Pengaju sekarang dapat mengunggah dokumen lanjutan.';
                break;

            case Pengeluaran::STATUS_DOCS_2_UPLOADED:
                $sumberdana = $pengeluaran->sumberdana;
                if ($sumberdana->pagu < $pengeluaran->jumlah) {
                    return redirect()
                        ->route('admin.pengeluaran.index')
                        ->with('error', 'Pagu sumber dana tidak mencukupi.');
                }

                $pengeluaran->update([
                    'status'      => Pengeluaran::STATUS_COMPLETED,
                    'approved_by' => Auth::id(),
                    'approved_at' => $now,
                    'rejection_reason' => null,
                ]);

                $sumberdana->decrement('pagu', $pengeluaran->jumlah);
                $msg = 'Pengeluaran selesai. Dana telah dikurangkan dari pagu sumber dana.';
                break;

            default:
                return redirect()
                    ->route('admin.pengeluaran.index')
                    ->with('error', 'Status tidak valid untuk disetujui.');
        }

        return redirect()
            ->route('admin.pengeluaran.index')
            ->with('success', $msg);
    }

    public function reject(Request $request, Pengeluaran $pengeluaran)
    {
        abort_unless(Auth::user()->role === 'admin', 403);

        $validated = $request->validate([
            'rejection_reason' => ['required', 'string', 'max:500'],
        ]);

        $pengeluaran->update([
            'status'            => Pengeluaran::STATUS_REJECTED,
            'approved_by'       => Auth::id(),
            'approved_at'       => now(),
            'rejection_reason'  => $validated['rejection_reason'],
        ]);

        return redirect()
            ->route('admin.pengeluaran.index')
            ->with('success', 'Pengeluaran ditolak.');
    }

    public function uploadDocument(Request $request, Pengeluaran $pengeluaran)
    {
        abort_unless($pengeluaran->user_id === Auth::id(), 403);

        $validStatuses = [Pengeluaran::STATUS_APPROVED_1, Pengeluaran::STATUS_APPROVED_2];
        abort_unless(in_array($pengeluaran->status, $validStatuses), 403, 'Tidak dapat mengunggah dokumen pada status ini.');

        $stage = $pengeluaran->status === Pengeluaran::STATUS_APPROVED_1 ? 1 : 2;

        $validated = $request->validate([
            'document' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png,doc,docx', 'max:5120'],
        ]);

        $file = $request->file('document');
        $filename = 'pengeluaran_' . $pengeluaran->id . '_doc' . $stage . '_' . time() . '.' . $file->extension();
        $path = $file->storeAs('documents/pengeluaran', $filename, 'public');

        $updateData = [
            'document_' . $stage . '_name' => $file->getClientOriginalName(),
            'document_' . $stage . '_path' => $path,
        ];

        if ($stage === 1) {
            $updateData['status'] = Pengeluaran::STATUS_DOCS_1_UPLOADED;
        } else {
            $updateData['status'] = Pengeluaran::STATUS_DOCS_2_UPLOADED;
        }

        $pengeluaran->update($updateData);

        $route = Auth::user()->role === 'admin' ? 'admin.pengeluaran.index' : 'user.pengeluaran.index';
        return redirect()
            ->route($route)
            ->with('success', 'Dokumen berhasil diunggah.');
    }

    public function downloadDocument(Pengeluaran $pengeluaran, $stage)
    {
        abort_unless(in_array($stage, [1, 2]), 404);

        $pathField = 'document_' . $stage . '_path';
        $nameField = 'document_' . $stage . '_name';

        abort_unless($pengeluaran->$pathField, 404, 'Dokumen tidak ditemukan.');

        if (Auth::user()->role !== 'admin' && $pengeluaran->user_id !== Auth::id()) {
            abort(403);
        }

        return Storage::disk('public')->download($pengeluaran->$pathField, $pengeluaran->$nameField);
    }

    public function exportPdf()
    {
        $pengeluarans = Pengeluaran::with(['sumberdana', 'user'])
            ->latest('tanggal')
            ->get();

        $pdf = Pdf::loadView('admin.Pengeluaran.export-pdf', compact('pengeluarans'));
        return $pdf->download('laporan-pengeluaran-' . now()->format('Y-m-d') . '.pdf');
    }

    public function exportExcel()
    {
        $pengeluarans = Pengeluaran::with(['sumberdana', 'user'])
            ->latest('tanggal')
            ->get();

        return Excel::download(new \App\Exports\PengeluaranExport($pengeluarans), 'laporan-pengeluaran-' . now()->format('Y-m-d') . '.xlsx');
    }
}
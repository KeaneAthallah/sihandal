<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use App\Models\Sumberdana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengeluaranController extends Controller
{
    public function index(Request $request)
    {
        $pengeluarans = Pengeluaran::with(['sumberdana', 'user', 'approver'])
            ->when(!$request->user()->can('approve-pengeluaran'), function ($query) use ($request) {
                // OPD users only see their own requests
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

        return view('pengeluaran.index', compact('pengeluarans'));
    }

    public function create()
    {
        $sumberdanas = Sumberdana::orderBy('nm_skpd')->get();
        return view('pengeluaran.create', compact('sumberdanas'));
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
        $validated['status'] = 'pending';

        Pengeluaran::create($validated);

        return redirect()
            ->route('pengeluaran.index')
            ->with('success', 'Permintaan pengeluaran berhasil diajukan.');
    }

    public function show(Pengeluaran $pengeluaran)
    {
        $pengeluaran->load(['sumberdana', 'user', 'approver']);
        return view('pengeluaran.show', compact('pengeluaran'));
    }

    public function edit(Pengeluaran $pengeluaran)
    {
        abort_unless($pengeluaran->status === 'pending', 403, 'Hanya permintaan berstatus pending yang dapat diubah.');
        abort_unless($pengeluaran->user_id === Auth::id(), 403);

        $sumberdanas = Sumberdana::orderBy('nm_skpd')->get();
        return view('pengeluaran.edit', compact('pengeluaran', 'sumberdanas'));
    }

    public function update(Request $request, Pengeluaran $pengeluaran)
    {
        abort_unless($pengeluaran->status === 'pending', 403, 'Hanya permintaan berstatus pending yang dapat diubah.');
        abort_unless($pengeluaran->user_id === Auth::id(), 403);

        $validated = $request->validate([
            'sumberdana_id' => ['required', 'exists:sumberdana,id'],
            'tanggal'       => ['required', 'date'],
            'jumlah'        => ['required', 'numeric', 'min:0'],
            'keterangan'    => ['nullable', 'string', 'max:500'],
        ]);

        $pengeluaran->update($validated);

        return redirect()
            ->route('pengeluaran.index')
            ->with('success', 'Permintaan pengeluaran berhasil diperbarui.');
    }

    public function destroy(Pengeluaran $pengeluaran)
    {
        abort_unless($pengeluaran->status === 'pending', 403, 'Hanya permintaan berstatus pending yang dapat dihapus.');
        abort_unless($pengeluaran->user_id === Auth::id(), 403);

        $pengeluaran->delete();

        return redirect()
            ->route('pengeluaran.index')
            ->with('success', 'Permintaan pengeluaran berhasil dihapus.');
    }

    public function approve(Pengeluaran $pengeluaran)
    {
        $this->authorize('approve-pengeluaran', $pengeluaran);

        $pengeluaran->update([
            'status'      => 'approved',
            'approved_by' => Auth::id(),
            'approved_at' => now(),
            'rejection_reason' => null,
        ]);

        return redirect()
            ->route('pengeluaran.show', $pengeluaran)
            ->with('success', 'Pengeluaran disetujui.');
    }

    public function reject(Request $request, Pengeluaran $pengeluaran)
    {
        $this->authorize('approve-pengeluaran', $pengeluaran);

        $validated = $request->validate([
            'rejection_reason' => ['required', 'string', 'max:500'],
        ]);

        $pengeluaran->update([
            'status'            => 'rejected',
            'approved_by'       => Auth::id(),
            'approved_at'       => now(),
            'rejection_reason'  => $validated['rejection_reason'],
        ]);

        return redirect()
            ->route('pengeluaran.show', $pengeluaran)
            ->with('success', 'Pengeluaran ditolak.');
    }
}

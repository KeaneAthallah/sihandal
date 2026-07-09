<?php

namespace App\Http\Controllers;

use App\Models\HeaderBelanja;
use Illuminate\Http\Request;

class HeaderBelanjaController extends Controller
{
    public function index(Request $request)
    {
        $query = HeaderBelanja::query();

        if ($request->filled('tahun')) {
            $query->whereYear('tgl_sp2d', $request->tahun);
        }

        if ($request->filled('unit_skpd')) {
            $query->where('unit_skpd', 'like', '%' . $request->unit_skpd . '%');
        }

        if ($request->filled('no_sp2d')) {
            $query->where('no_sp2d', 'like', '%' . $request->no_sp2d . '%');
        }

        if ($request->filled('jenis_sp2')) {
            $query->where('jenis_sp2', $request->jenis_sp2);
        }

        $headerBelanja = $query->orderBy('tgl_sp2d', 'desc')->paginate(15);

        $totalBrutto = $query->sum('brutto');
        $totalSP2D = $query->count();
        $totalUnit = $query->distinct('unit_skpd')->count('unit_skpd');

        return view('admin.header-belanja.index', compact('headerBelanja', 'totalBrutto', 'totalSP2D', 'totalUnit'));
    }

    public function create()
    {
        return view('admin.header-belanja.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor' => 'required|string|max:100',
            'tgl_sp2d' => 'required|date',
            'no_sp2d' => 'required|string|max:100|unique:header-belanja,no_sp2d',
            'unit_skpd' => 'required|string|max:255',
            'nama_penerima' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'jenis_sp2' => 'required|string|max:10|in:LS,GU,TU,UP',
            'brutto' => 'required|numeric|min:0'
        ]);

        HeaderBelanja::create($request->all());

        return redirect()->route('admin.header-belanja.index')
            ->with('success', 'Data header belanja berhasil ditambahkan.');
    }

    public function show(HeaderBelanja $headerBelanja)
    {
        return view('admin.header-belanja.show', compact('headerBelanja'));
    }

    public function edit(HeaderBelanja $headerBelanja)
    {
        return view('admin.header-belanja.edit', compact('headerBelanja'));
    }

    public function update(Request $request, HeaderBelanja $headerBelanja)
    {
        $request->validate([
            'nomor' => 'required|string|max:100',
            'tgl_sp2d' => 'required|date',
            'no_sp2d' => 'required|string|max:100|unique:header-belanja,no_sp2d,' . $headerBelanja->id,
            'unit_skpd' => 'required|string|max:255',
            'nama_penerima' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'jenis_sp2' => 'required|string|max:10|in:LS,GU,TU,UP',
            'brutto' => 'required|numeric|min:0'
        ]);

        $headerBelanja->update($request->all());

        return redirect()->route('admin.header-belanja.index')
            ->with('success', 'Data header belanja berhasil diperbarui.');
    }

    public function destroy(HeaderBelanja $headerBelanja)
    {
        $headerBelanja->delete();

        return redirect()->route('admin.header-belanja.index')
            ->with('success', 'Data header belanja berhasil dihapus.');
    }
}

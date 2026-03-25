<?php

namespace App\Http\Controllers;

use App\Models\Realisasi;
use App\Models\Sumberdana;
use Illuminate\Http\Request;

class RealisasiController extends Controller
{
    public function index(Request $request)
    {
        $query = Realisasi::with('sumberDana');

        if ($request->filled('tahun')) {
            $query->whereYear('tgl_sp2d', $request->tahun);
        }

        if ($request->filled('bulan')) {
            $query->where('bulan', $request->bulan);
        }

        if ($request->filled('sumberdana')) {
            $query->where('sumberdana', $request->sumberdana);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('no_sp2d', 'like', "%{$search}%")
                    ->orWhere('kdskpd', 'like', "%{$search}%")
                    ->orWhere('nmskpd', 'like', "%{$search}%")
                    ->orWhere('nmrek', 'like', "%{$search}%");
            });
        }

        $realisasi = $query->orderBy('tgl_sp2d', 'desc')->paginate(15);

        $totalNilai = $query->sum('nilai');
        $totalTransaksi = $query->count();
        $bulanAktif = $query->distinct('bulan')->count('bulan');

        $bulanList = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        return view('realisasi.index', compact('realisasi', 'totalNilai', 'totalTransaksi', 'bulanAktif', 'bulanList'));
    }

    public function create()
    {
        $sumberDana = Sumberdana::orderBy('kd_skpd')->get();
        return view('realisasi.create', compact('sumberDana'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bulan' => 'required|integer|between:1,12',
            'kdskpd' => 'required|string|max:50',
            'nmskpd' => 'required|string|max:255',
            'nilai' => 'required|numeric|min:0',
            'tgl_sp2d' => 'required|date',
            'no_sp2d' => 'required|string|max:100|unique:realisasi_rincian_belanja,no_sp2d',
            'sumberdana' => 'required|string|max:100',
            'kdsubunit' => 'nullable|string|max:50',
            'nmsubunit' => 'nullable|string|max:255',
            'kdkegiatan' => 'nullable|string|max:50',
            'nmkegiatan' => 'nullable|string|max:255',
            'kdsubkegiatan' => 'nullable|string|max:50',
            'nmsubkegiatan' => 'nullable|string|max:255',
            'kdrek' => 'nullable|string|max:50',
            'nmrek' => 'nullable|string|max:255',
            'id_smb' => 'nullable|exists:sumberdana,id'
        ]);

        Realisasi::create($request->all());

        return redirect()->route('realisasi.index')
            ->with('success', 'Data realisasi belanja berhasil ditambahkan.');
    }

    public function edit(Realisasi $realisasi)
    {
        $sumberDana = Sumberdana::orderBy('kd_skpd')->get();
        return view('realisasi.edit', compact('realisasi', 'sumberDana'));
    }

    public function update(Request $request, Realisasi $realisasi)
    {
        $request->validate([
            'bulan' => 'required|integer|between:1,12',
            'kdskpd' => 'required|string|max:50',
            'nmskpd' => 'required|string|max:255',
            'nilai' => 'required|numeric|min:0',
            'tgl_sp2d' => 'required|date',
            'no_sp2d' => 'required|string|max:100|unique:realisasi_rincian_belanja,no_sp2d,' . $realisasi->id,
            'sumberdana' => 'required|string|max:100',
            'kdsubunit' => 'nullable|string|max:50',
            'nmsubunit' => 'nullable|string|max:255',
            'kdkegiatan' => 'nullable|string|max:50',
            'nmkegiatan' => 'nullable|string|max:255',
            'kdsubkegiatan' => 'nullable|string|max:50',
            'nmsubkegiatan' => 'nullable|string|max:255',
            'kdrek' => 'nullable|string|max:50',
            'nmrek' => 'nullable|string|max:255',
            'id_smb' => 'nullable|exists:sumberdana,id'
        ]);

        $realisasi->update($request->all());

        return redirect()->route('realisasi.index')
            ->with('success', 'Data realisasi belanja berhasil diperbarui.');
    }

    public function destroy(Realisasi $realisasi)
    {
        $realisasi->delete();

        return redirect()->route('realisasi.index')
            ->with('success', 'Data realisasi belanja berhasil dihapus.');
    }
}

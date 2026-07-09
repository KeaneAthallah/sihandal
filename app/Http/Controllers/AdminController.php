<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\Sumberdana;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalSumberdana = Sumberdana::count();
        $totalPagu = Sumberdana::sum('pagu');

        $totalPemasukan = Pemasukan::count();
        $totalPemasukanApproved = Pemasukan::where('status', 'approved')->count();
        $totalPemasukanPending = Pemasukan::where('status', 'pending')->count();

        $totalPengeluaran = Pengeluaran::count();
        $totalPengeluaranApproved = Pengeluaran::where('status', 'approved')->count();
        $totalPengeluaranPending = Pengeluaran::where('status', 'pending')->count();

        $recentPemasukans = Pemasukan::with(['sumberdana', 'user'])
            ->latest('tanggal')
            ->limit(5)
            ->get();

        $recentPengeluarans = Pengeluaran::with(['sumberdana', 'user'])
            ->latest('tanggal')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalSumberdana',
            'totalPagu',
            'totalPemasukan',
            'totalPemasukanApproved',
            'totalPemasukanPending',
            'totalPengeluaran',
            'totalPengeluaranApproved',
            'totalPengeluaranPending',
            'recentPemasukans',
            'recentPengeluarans'
        ));
    }
}

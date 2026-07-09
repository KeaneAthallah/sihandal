<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\Sumberdana;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $userSkpd = $user->skpd;

        $totalPaguSkpd = 0;
        $jumlahKegiatan = 0;
        $jumlahSubKegiatan = 0;

        if ($userSkpd) {
            $skpdData = Sumberdana::select(
                DB::raw('SUM(pagu) as total_pagu'),
                DB::raw('AVG(pagu_percentage) as percentage')
            )
                ->where('kd_skpd', $userSkpd)
                ->first();

            if ($skpdData && $skpdData->percentage > 0) {
                $totalPaguSkpd = ($skpdData->total_pagu * $skpdData->percentage) / 100;
            } else {
                $totalPaguSkpd = $skpdData->total_pagu ?? 0;
            }

            $jumlahKegiatan = Sumberdana::where('kd_skpd', $userSkpd)
                ->distinct('kd_kegiatan')
                ->count('kd_kegiatan');

            $jumlahSubKegiatan = Sumberdana::where('kd_skpd', $userSkpd)
                ->distinct('kd_subkegiatan')
                ->count('kd_subkegiatan');
        }

        $jumlahPemasukan = Pemasukan::where('user_id', $user->id)->count();
        $jumlahPemasukanApproved = Pemasukan::where('user_id', $user->id)->where('status', 'approved')->count();
        $jumlahPemasukanPending = Pemasukan::where('user_id', $user->id)->where('status', 'pending')->count();

        $jumlahPengeluaran = Pengeluaran::where('user_id', $user->id)->count();
        $jumlahPengeluaranApproved = Pengeluaran::where('user_id', $user->id)->where('status', 'approved')->count();
        $jumlahPengeluaranPending = Pengeluaran::where('user_id', $user->id)->where('status', 'pending')->count();

        $recentPemasukans = Pemasukan::with('sumberdana')
            ->where('user_id', $user->id)
            ->latest('tanggal')
            ->limit(5)
            ->get();

        $recentPengeluarans = Pengeluaran::with('sumberdana')
            ->where('user_id', $user->id)
            ->latest('tanggal')
            ->limit(5)
            ->get();

        return view('user.dashboard', compact(
            'totalPaguSkpd',
            'jumlahKegiatan',
            'jumlahSubKegiatan',
            'jumlahPemasukan',
            'jumlahPemasukanApproved',
            'jumlahPemasukanPending',
            'jumlahPengeluaran',
            'jumlahPengeluaranApproved',
            'jumlahPengeluaranPending',
            'recentPemasukans',
            'recentPengeluarans'
        ));
    }
}

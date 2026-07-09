<?php

namespace App\Http\Controllers;

use App\Models\Sumberdana;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $userSkpd = $user->skpd;

        if ($userSkpd) {
            // Get SKPD data with percentage
            $skpdData = Sumberdana::select(
                DB::raw('SUM(pagu) as total_pagu'),
                DB::raw('AVG(pagu_percentage) as percentage')
            )
                ->where('kd_skpd', $userSkpd)
                ->first();

            if ($skpdData && $skpdData->percentage > 0) {
                // Use percentage setting
                $totalPaguSkpd = ($skpdData->total_pagu * $skpdData->percentage) / 100;
            } else {
                // Use full pagu
                $totalPaguSkpd = $skpdData->total_pagu ?? 0;
            }

            $jumlahKegiatan = Sumberdana::where('kd_skpd', $userSkpd)
                ->distinct('kd_kegiatan')
                ->count('kd_kegiatan');

            $jumlahSubKegiatan = Sumberdana::where('kd_skpd', $userSkpd)
                ->distinct('kd_subkegiatan')
                ->count('kd_subkegiatan');
        }


        return view('user.dashboard', compact(
            'totalPaguSkpd',
            'jumlahKegiatan',
            'jumlahSubKegiatan'
        ));
    }
}

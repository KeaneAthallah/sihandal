<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sumberdana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    /**
     * Display settings page with SKPD list and percentage settings
     */
    public function index()
    {
        // Get all SKPD with their total pagu and current percentage
        $skpdSettings = Sumberdana::select(
            'kd_skpd',
            'nm_skpd',
            DB::raw('SUM(pagu) as total_pagu'),
            DB::raw('AVG(pagu_percentage) as percentage')
        )
            ->whereNotNull('kd_skpd')
            ->groupBy('kd_skpd', 'nm_skpd')
            ->orderBy('nm_skpd')
            ->get()
            ->map(function ($item) {
                $item->percentage = $item->percentage ?: 0;
                $item->display_pagu = ($item->total_pagu * $item->percentage) / 100;
                return $item;
            });

        // Calculate total pagu keseluruhan
        $totalPaguOverall = Sumberdana::sum('pagu');

        return view('admin.setting', compact('skpdSettings', 'totalPaguOverall'));
    }

    /**
     * Update percentage setting for a specific SKPD
     */
    public function update(Request $request)
    {
        $request->validate([
            'kd_skpd' => 'required|string',
            'percentage' => 'required|numeric|min:0|max:100',
            'apply_to_all' => 'nullable|boolean'
        ]);

        try {
            DB::beginTransaction();

            $kdSkpd = $request->kd_skpd;
            $percentage = $request->percentage;
            $applyToAll = $request->apply_to_all ?? false;

            if ($applyToAll) {
                // Apply percentage to all records of this SKPD
                Sumberdana::where('kd_skpd', $kdSkpd)
                    ->update(['pagu_percentage' => $percentage]);
            } else {
                // Update only the first record (or you can specify which one)
                Sumberdana::where('kd_skpd', $kdSkpd)
                    ->limit(1)
                    ->update(['pagu_percentage' => $percentage]);
            }

            DB::commit();

            return redirect()->route('admin.setting')
                ->with('success', "Setting persentase {$percentage}% berhasil diterapkan untuk SKPD " . $kdSkpd);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Gagal memperbarui setting: ' . $e->getMessage());
        }
    }

    /**
     * Update multiple SKPD percentages at once
     */
    public function updateBatch(Request $request)
    {
        $request->validate([
            'settings' => 'required|array',
            'settings.*.kd_skpd' => 'required|string',
            'settings.*.percentage' => 'required|numeric|min:0|max:100'
        ]);

        try {
            DB::beginTransaction();

            foreach ($request->settings as $setting) {
                Sumberdana::where('kd_skpd', $setting['kd_skpd'])
                    ->update(['pagu_percentage' => $setting['percentage']]);
            }

            DB::commit();

            return redirect()->route('admin.setting')
                ->with('success', 'Semua setting persentase berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Gagal memperbarui setting: ' . $e->getMessage());
        }
    }

    /**
     * Reset all percentages to 0
     */
    public function reset()
    {
        try {
            Sumberdana::query()->update(['pagu_percentage' => 0]);

            return redirect()->route('admin.setting')
                ->with('success', 'Semua setting persentase berhasil direset ke 0%');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal reset setting: ' . $e->getMessage());
        }
    }

    /**
     * Apply same percentage to all SKPD
     */
    public function applyToAll(Request $request)
    {
        $request->validate([
            'percentage' => 'required|numeric|min:0|max:100'
        ]);

        try {
            $percentage = $request->percentage;

            // Apply percentage to all SKPD
            Sumberdana::query()->update(['pagu_percentage' => $percentage]);

            return redirect()->route('admin.setting')
                ->with('success', "Setting persentase {$percentage}% berhasil diterapkan ke semua SKPD");
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menerapkan persentase: ' . $e->getMessage());
        }
    }

    /**
     * Calculate displayed pagu based on percentage
     */
    public function calculateDisplayPagu($skpdCode)
    {
        $skpd = Sumberdana::select(
            'kd_skpd',
            DB::raw('SUM(pagu) as total_pagu'),
            DB::raw('AVG(pagu_percentage) as percentage')
        )
            ->where('kd_skpd', $skpdCode)
            ->groupBy('kd_skpd')
            ->first();

        if ($skpd && $skpd->percentage > 0) {
            $displayPagu = ($skpd->total_pagu * $skpd->percentage) / 100;
            return $displayPagu;
        }

        return $skpd->total_pagu ?? 0;
    }
}

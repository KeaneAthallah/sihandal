<?php

namespace App\Http\Controllers;

use App\Models\Sumberdana;
use App\Imports\SumberdanaImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class SumberdanaController extends Controller
{
    public function index(Request $request)
    {
        $query = Sumberdana::query();

        if ($request->has('kd_skpd') && $request->kd_skpd) {
            $query->where('kd_skpd', $request->kd_skpd);
        }

        if ($request->has('kd_kegiatan') && $request->kd_kegiatan) {
            $query->where('kd_kegiatan', $request->kd_kegiatan);
        }

        if ($request->has('sumberdana') && $request->sumberdana) {
            $query->where('sumberdana', $request->sumberdana);
        }

        if ($request->has('search') && $request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('nm_skpd', 'like', '%' . $request->search . '%')
                    ->orWhere('nm_kegiatan', 'like', '%' . $request->search . '%')
                    ->orWhere('nm_subkegiatan', 'like', '%' . $request->search . '%')
                    ->orWhere('nm_rek', 'like', '%' . $request->search . '%')
                    ->orWhere('kd_rek', 'like', '%' . $request->search . '%');
            });
        }

        $sumberdana = $query->orderBy('id', 'desc')->paginate(50);

        $skpdList = Sumberdana::select('kd_skpd', 'nm_skpd')
            ->distinct()
            ->whereNotNull('kd_skpd')
            ->orderBy('nm_skpd')
            ->get();

        $sumberDanaList = Sumberdana::select('sumberdana')
            ->distinct()
            ->whereNotNull('sumberdana')
            ->orderBy('sumberdana')
            ->get();

        $statistics = [
            'total_records' => Sumberdana::count(),
            'total_pagu' => Sumberdana::sum('pagu'),
            'unique_skpd' => Sumberdana::distinct('kd_skpd')->count('kd_skpd'),
            'unique_kegiatan' => Sumberdana::distinct('kd_kegiatan')->count('kd_kegiatan'),
        ];

        return view('admin.sumberdana.index', compact('sumberdana', 'skpdList', 'sumberDanaList', 'statistics'));
    }

    public function create()
    {
        return view('admin.sumberdana.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kd_rek' => 'required|string|max:100',
            'kd_skpd' => 'nullable|string|max:50',
            'nm_skpd' => 'nullable|string|max:255',
            'kd_kegiatan' => 'nullable|string|max:50',
            'nm_kegiatan' => 'nullable|string|max:255',
            'pagu' => 'nullable|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Sumberdana::create($request->all());

        return redirect()->route('sumberdana.index')
            ->with('success', 'Data berhasil ditambahkan');
    }

    public function show(Sumberdana $sumberdana)
    {
        return redirect()->route('sumberdana.edit', $sumberdana);
    }

    public function edit(Sumberdana $sumberdana)
    {
        return view('admin.sumberdana.edit', compact('sumberdana'));
    }

    public function update(Request $request, Sumberdana $sumberdana)
    {
        $validator = Validator::make($request->all(), [
            'kd_rek' => 'required|string|max:100',
            'kd_skpd' => 'nullable|string|max:50',
            'nm_skpd' => 'nullable|string|max:255',
            'kd_kegiatan' => 'nullable|string|max:50',
            'nm_kegiatan' => 'nullable|string|max:255',
            'pagu' => 'nullable|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $sumberdana->update($request->all());

        return redirect()->route('sumberdana.index')
            ->with('success', 'Data berhasil diperbarui');
    }

    public function destroy(Sumberdana $sumberdana)
    {
        $sumberdana->delete();

        return redirect()->route('sumberdana.index')
            ->with('success', 'Data berhasil dihapus');
    }

    public function showImportForm()
    {
        return view('admin.sumberdana.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:20480', // Only CSV files
        ]);

        set_time_limit(0);
        ini_set('memory_limit', '1024M');

        try {
            DB::beginTransaction();

            $import = new SumberdanaImport();
            $file = $request->file('file');

            Log::info('Starting CSV import', [
                'file_name' => $file->getClientOriginalName(),
                'file_size' => $file->getSize(),
                'file_mime' => $file->getMimeType()
            ]);

            // Perform import
            Excel::import($import, $file);

            DB::commit();

            $totalRows = $import->getRowCount();
            $successCount = $import->getSuccessCount();
            $failedCount = count($import->getFailedRows());

            Log::info('Import completed', [
                'total' => $totalRows,
                'success' => $successCount,
                'failed' => $failedCount
            ]);

            if ($totalRows == 0) {
                return redirect()->back()
                    ->with('error', 'Tidak ada data yang diimport. Pastikan file CSV memiliki data.')
                    ->withInput();
            }

            $message = sprintf(
                'Import selesai. Total baris: %d, Berhasil: %d, Gagal: %d',
                $totalRows,
                $successCount,
                $failedCount
            );

            $redirect = redirect()->route('sumberdana.index')
                ->with('success', $message);

            if ($failedCount > 0) {
                $redirect->with('warning', $failedCount . ' baris gagal diimport. Periksa format data.')
                    ->with('failed_rows', array_slice($import->getFailedRows(), 0, 100));
            }

            return $redirect;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Import failed: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function downloadTemplate()
    {
        $callback = function () {
            $file = fopen('php://output', 'w');
            // Add UTF-8 BOM for Excel compatibility
            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));

            // Add sample data rows (no header)
            $samples = [
                [
                    '1',
                    '1.01.0.00.0.00.01.0000',
                    'Dinas Pendidikan Daerah Provinsi Sulawesi Tengah',
                    '1.01.0.00.0.00.01.0000',
                    'Dinas Pendidikan Daerah Provinsi Sulawesi Tengah',
                    '1.01.01.1.02',
                    'Administrasi Keuangan Perangkat Daerah',
                    '1.01.01.1.02.0001',
                    'Penyediaan Gaji dan Tunjangan ASN',
                    '5.1.01.01.01.0001',
                    'Belanja Gaji Pokok PNS',
                    '39744976250',
                    'DAU yang Ditentukan Penggunaannya Bidang Pendidikan'
                ],
                [
                    '2',
                    '1.01.0.00.0.00.01.0000',
                    'Dinas Pendidikan Daerah Provinsi Sulawesi Tengah',
                    '1.01.0.00.0.00.01.0000',
                    'Dinas Pendidikan Daerah Provinsi Sulawesi Tengah',
                    '1.01.02.1.01',
                    'Pengelolaan Pendidikan Sekolah Menengah Atas',
                    '1.01.02.1.01.0014',
                    'Pembangunan Sarana, Prasarana dan Utilitas Sekolah',
                    '5.1.02.01.01.0024',
                    'Belanja Alat/Bahan untuk Kegiatan Kantor-Alat Tulis Kantor',
                    '883750',
                    'DAU yang Ditentukan Penggunaannya Bidang Pendidikan'
                ],
                [
                    '3',
                    '1.01.0.00.0.00.01.0000',
                    'Dinas Pendidikan Daerah Provinsi Sulawesi Tengah',
                    '1.01.0.00.0.00.01.0000',
                    'Dinas Pendidikan Daerah Provinsi Sulawesi Tengah',
                    '1.01.02.1.01',
                    'Pengelolaan Pendidikan Sekolah Menengah Atas',
                    '1.01.02.1.01.0014',
                    'Pembangunan Sarana, Prasarana dan Utilitas Sekolah',
                    '5.1.02.01.01.0027',
                    'Belanja Alat/Bahan untuk Kegiatan Kantor-Benda Pos',
                    '600000',
                    'DAU yang Ditentukan Penggunaannya Bidang Pendidikan'
                ]
            ];

            foreach ($samples as $sample) {
                fputcsv($file, $sample);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="template_sumberdana.csv"',
        ]);
    }

    public function truncate()
    {
        if (auth()->user()->role !== 'admin') {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        try {
            DB::beginTransaction();

            // Check if there are related records
            $hasRelatedRecords = DB::table('realisasi_rincian_belanja')
                ->whereIn('id_smb', function ($query) {
                    $query->select('id')->from('sumberdana');
                })
                ->exists();

            if ($hasRelatedRecords) {
                // Ask for confirmation with related records
                session()->flash('warning', 'Terdapat data terkait di tabel realisasi rincian belanja. Data terkait akan dihapus juga.');
            }

            // Disable foreign key checks
            DB::statement('SET FOREIGN_KEY_CHECKS=0');

            // Delete or truncate based on preference
            // Option A: Delete all (slower but safer)
            Sumberdana::query()->delete();

            // Option B: Truncate (faster but requires FK checks disabled)
            // Sumberdana::truncate();

            // Re-enable foreign key checks
            DB::statement('SET FOREIGN_KEY_CHECKS=1');

            DB::commit();

            return redirect()->route('sumberdana.index')
                ->with('success', 'Semua data berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();

            // Make sure foreign key checks are re-enabled
            DB::statement('SET FOREIGN_KEY_CHECKS=1');

            return redirect()->back()
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}

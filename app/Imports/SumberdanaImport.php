<?php

namespace App\Imports;

use App\Models\Sumberdana;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Facades\Log;

class SumberdanaImport implements ToModel, WithBatchInserts, WithChunkReading, SkipsOnFailure, WithStartRow
{
    use SkipsFailures;

    private $rowCount = 0;
    private $successCount = 0;
    private $failedRows = [];
    private $startTime;

    // Column indexes (0-based index)
    private const COL_NO = 0;
    private const COL_KD_SKPD = 1;
    private const COL_NM_SKPD = 2;
    private const COL_KD_SUBUNIT = 3;
    private const COL_NM_SUBUNIT = 4;
    private const COL_KD_KEGIATAN = 5;
    private const COL_NM_KEGIATAN = 6;
    private const COL_KD_SUB_KEGIATAN = 7;
    private const COL_NM_SUB_KEGIATAN = 8;
    private const COL_KD_REK = 9;
    private const COL_NM_REK = 10;
    private const COL_PAGU = 11;
    private const COL_SUMBER_DANA = 12;

    public function __construct()
    {
        $this->startTime = microtime(true);
    }

    /**
     * Start from row 2 (skip CSV header row)
     */
    public function startRow(): int
    {
        return 2;
    }

    /**
     * @param array $row
     */
    public function model(array $row)
    {
        $this->rowCount++;

        // Log progress every 1000 rows
        if ($this->rowCount % 1000 == 0) {
            $elapsed = round((microtime(true) - $this->startTime), 2);
            Log::info("Processing row {$this->rowCount} in {$elapsed} seconds");
        }

        // Check if row has enough columns
        if (count($row) < 13) {
            $this->failedRows[] = [
                'row' => $this->rowCount,
                'data' => $row,
                'error' => 'Row has ' . count($row) . ' columns, expected at least 13 columns'
            ];
            return null;
        }

        // Get values from columns
        $no = $this->cleanString($row[self::COL_NO] ?? null);
        $kd_skpd = $this->cleanString($row[self::COL_KD_SKPD] ?? null);
        $nm_skpd = $this->cleanString($row[self::COL_NM_SKPD] ?? null);
        $kd_subunit = $this->cleanString($row[self::COL_KD_SUBUNIT] ?? null);
        $nm_subunit = $this->cleanString($row[self::COL_NM_SUBUNIT] ?? null);
        $kd_kegiatan = $this->cleanString($row[self::COL_KD_KEGIATAN] ?? null);
        $nm_kegiatan = $this->cleanString($row[self::COL_NM_KEGIATAN] ?? null);
        $kd_subkegiatan = $this->cleanString($row[self::COL_KD_SUB_KEGIATAN] ?? null);
        $nm_subkegiatan = $this->cleanString($row[self::COL_NM_SUB_KEGIATAN] ?? null);
        $kd_rek = $this->cleanString($row[self::COL_KD_REK] ?? null);
        $nm_rek = $this->cleanString($row[self::COL_NM_REK] ?? null);
        $pagu = $this->cleanNumericValue($row[self::COL_PAGU] ?? 0);
        $sumberdana = $this->cleanString($row[self::COL_SUMBER_DANA] ?? null);

        // Check required field (KD REK)
        if (empty($kd_rek)) {
            $this->failedRows[] = [
                'row' => $this->rowCount,
                'data' => $row,
                'error' => 'Kode Rekening (column 10) is required'
            ];
            return null;
        }

        $this->successCount++;

        return new Sumberdana([
            'no' => $no,
            'kd_skpd' => $kd_skpd,
            'nm_skpd' => $nm_skpd,
            'kd_subunit' => $kd_subunit,
            'nm_subunit' => $nm_subunit,
            'kd_kegiatan' => $kd_kegiatan,
            'nm_kegiatan' => $nm_kegiatan,
            'kd_subkegiatan' => $kd_subkegiatan,
            'nm_subkegiatan' => $nm_subkegiatan,
            'kd_rek' => $kd_rek,
            'nm_rek' => $nm_rek,
            'pagu' => $pagu,
            'sumberdana' => $sumberdana,
        ]);
    }

    /**
     * Clean string value
     */
    private function cleanString($value)
    {
        if (empty($value)) {
            return null;
        }

        $value = trim((string) $value);

        // Remove BOM characters
        $value = preg_replace('/^\xEF\xBB\xBF/', '', $value);

        return $value !== '' ? $value : null;
    }

    /**
     * Clean numeric value (handle various formats)
     */
    private function cleanNumericValue($value)
    {
        if (empty($value)) {
            return 0;
        }

        // Convert to string and trim
        $value = trim((string) $value);

        // Remove spaces
        $value = preg_replace('/\s/', '', $value);

        // If it's already numeric
        if (is_numeric($value)) {
            return floatval($value);
        }

        // Handle Indonesian format with dots and commas
        // Example: "39,744,976,250.00" or "39.744.976.250,00"
        if (preg_match('/^\d+(\.\d{3})*,\d+$/', $value)) {
            // Format: 39.744.976.250,00
            $value = str_replace('.', '', $value);
            $value = str_replace(',', '.', $value);
        } elseif (preg_match('/^\d+(,\d{3})*\.\d+$/', $value)) {
            // Format: 39,744,976,250.00
            $value = str_replace(',', '', $value);
        } else {
            // Remove all non-numeric characters except dot and minus
            $value = preg_replace('/[^\d\-\.]/', '', $value);
        }

        return floatval($value);
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function getRowCount()
    {
        return $this->rowCount;
    }

    public function getSuccessCount()
    {
        return $this->successCount;
    }

    public function getFailedRows()
    {
        return $this->failedRows;
    }
}

<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PengeluaranExport implements FromCollection, WithHeadings, WithStyles
{
    protected $pengeluarans;

    public function __construct(Collection $pengeluarans)
    {
        $this->pengeluarans = $pengeluarans;
    }

    public function collection()
    {
        return $this->pengeluarans->map(fn($item) => [
            'Tanggal'        => $item->tanggal->format('d-m-Y'),
            'SKPD'           => $item->sumberdana->nm_skpd ?? '-',
            'Rekening'       => $item->sumberdana->nm_rek ?? '-',
            'Jumlah'         => $item->jumlah,
            'Keterangan'     => $item->keterangan ?? '-',
            'Diajukan Oleh'  => $item->user->name ?? '-',
            'Status'         => \App\Models\Pengeluaran::statusLabel($item->status),
        ]);
    }

    public function headings(): array
    {
        return ['Tanggal', 'SKPD', 'Rekening', 'Jumlah', 'Keterangan', 'Diajukan Oleh', 'Status'];
    }

    public function styles(Worksheet $sheet)
    {
        return [1 => ['font' => ['bold' => true]]];
    }
}
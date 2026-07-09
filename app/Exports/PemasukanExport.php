<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PemasukanExport implements FromCollection, WithHeadings, WithStyles
{
    protected $pemasukans;

    public function __construct(Collection $pemasukans)
    {
        $this->pemasukans = $pemasukans;
    }

    public function collection()
    {
        return $this->pemasukans->map(fn($item) => [
            'Tanggal'        => $item->tanggal->format('d-m-Y'),
            'SKPD'           => $item->sumberdana->nm_skpd ?? '-',
            'Rekening'       => $item->sumberdana->nm_rek ?? '-',
            'Jumlah'         => $item->jumlah,
            'Keterangan'     => $item->keterangan ?? '-',
            'Diajukan Oleh'  => $item->user->name ?? '-',
            'Status'         => \App\Models\Pemasukan::statusLabel($item->status),
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
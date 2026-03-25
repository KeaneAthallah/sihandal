<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeaderBelanja extends Model
{
    use HasFactory;

    protected $table = 'header_belanja';

    protected $fillable = [
        'nomor',
        'tgl_sp2d',
        'no_sp2d',
        'unit_skpd',
        'nama_penerima',
        'keterangan',
        'jenis_sp2',
        'brutto'
    ];

    protected $casts = [
        'tgl_sp2d' => 'date',
        'brutto' => 'decimal:2'
    ];

    public function getFormattedBruttoAttribute()
    {
        return 'Rp ' . number_format($this->brutto, 0, ',', '.');
    }

    public function getJenisSp2LabelAttribute()
    {
        $labels = [
            'LS' => 'Langsung',
            'GU' => 'Ganti Uang',
            'TU' => 'Tambah Uang',
            'UP' => 'Uang Persediaan'
        ];

        return $labels[$this->jenis_sp2] ?? $this->jenis_sp2;
    }
}

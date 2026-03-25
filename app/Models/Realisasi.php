<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Realisasi extends Model
{
    use HasFactory;

    protected $table = 'realisasi_rincian_belanja';

    protected $fillable = [
        'bulan',
        'kdskpd',
        'nmskpd',
        'kdsubunit',
        'nmsubunit',
        'kdkegiatan',
        'nmkegiatan',
        'kdsubkegiatan',
        'nmsubkegiatan',
        'kdrek',
        'nmrek',
        'nilai',
        'tgl_sp2d',
        'no_sp2d',
        'sumberdana',
        'id_smb'
    ];

    protected $casts = [
        'tgl_sp2d' => 'date',
        'nilai' => 'decimal:2'
    ];

    public function sumberDana()
    {
        return $this->belongsTo(Sumberdana::class, 'id_smb', 'id');
    }

    public function getFormattedNilaiAttribute()
    {
        return 'Rp ' . number_format($this->nilai, 0, ',', '.');
    }

    public function getNamaBulanAttribute()
    {
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

        return $bulanList[$this->bulan] ?? '-';
    }
}

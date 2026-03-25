<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sumberdana extends Model
{
    use HasFactory;

    protected $table = 'sumberdana';

    protected $fillable = [
        'no',
        'kd_skpd',
        'nm_skpd',
        'kd_subunit',
        'nm_subunit',
        'kd_kegiatan',
        'nm_kegiatan',
        'kd_subkegiatan',
        'nm_subkegiatan',
        'kd_rek',
        'nm_rek',
        'pagu',
        'sumberdana',
    ];

    protected $casts = [
        'pagu' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function realisasi()
    {
        return $this->hasMany(Realisasi::class, 'id_smb', 'id');
    }
}

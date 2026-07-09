<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'sumberdana_id',
        'user_id',
        'tanggal',
        'jumlah',
        'keterangan',
        'status',
        'approved_by',
        'approved_at',
        'rejection_reason',
    ];

    protected $casts = [
        'tanggal'     => 'date',
        'jumlah'      => 'decimal:2',
        'approved_at' => 'datetime',
    ];

    public function sumberdana()
    {
        return $this->belongsTo(Sumberdana::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
}

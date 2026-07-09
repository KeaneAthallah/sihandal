<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    use HasFactory;

    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED_1 = 'approved_1';
    const STATUS_DOCS_1_UPLOADED = 'docs_1_uploaded';
    const STATUS_APPROVED_2 = 'approved_2';
    const STATUS_DOCS_2_UPLOADED = 'docs_2_uploaded';
    const STATUS_COMPLETED = 'completed';
    const STATUS_REJECTED = 'rejected';

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
        'document_1_name',
        'document_1_path',
        'document_2_name',
        'document_2_path',
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
        return $query->where('status', self::STATUS_PENDING);
    }

    public function scopeActive($query)
    {
        return $query->whereNotIn('status', [self::STATUS_COMPLETED, self::STATUS_REJECTED]);
    }

    public static function statusLabel(string $status): string
    {
        return [
            self::STATUS_PENDING => 'Menunggu Persetujuan',
            self::STATUS_APPROVED_1 => 'Disetujui (Lv.1)',
            self::STATUS_DOCS_1_UPLOADED => 'Dokumen-1 Diupload',
            self::STATUS_APPROVED_2 => 'Disetujui (Lv.2)',
            self::STATUS_DOCS_2_UPLOADED => 'Dokumen-2 Diupload',
            self::STATUS_COMPLETED => 'Selesai',
            self::STATUS_REJECTED => 'Ditolak',
        ][$status] ?? $status;
    }

    public static function statusColor(string $status): string
    {
        return [
            self::STATUS_PENDING => 'badge-warning',
            self::STATUS_APPROVED_1 => 'badge-info',
            self::STATUS_DOCS_1_UPLOADED => 'badge-info',
            self::STATUS_APPROVED_2 => 'badge-info',
            self::STATUS_DOCS_2_UPLOADED => 'badge-info',
            self::STATUS_COMPLETED => 'badge-success',
            self::STATUS_REJECTED => 'badge-danger',
        ][$status] ?? 'badge-warning';
    }
}
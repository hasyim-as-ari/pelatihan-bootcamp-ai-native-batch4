<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notifikasi extends Model
{
    protected $table = 'notifikasi';

    protected $fillable = [
        'user_id',
        'judul',
        'pesan',
        'tipe',
        'tautan',
        'dibaca',
        'dibaca_pada',
    ];

    protected $casts = [
        'dibaca' => 'boolean',
        'dibaca_pada' => 'datetime',
    ];

    /**
     * Relasi ke user
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Tandai notifikasi sebagai sudah dibaca
     */
    public function tandaiDibaca(): void
    {
        $this->update([
            'dibaca' => true,
            'dibaca_pada' => now(),
        ]);
    }

    /**
     * Scope notifikasi belum dibaca
     */
    public function scopeBelumDibaca($query)
    {
        return $query->where('dibaca', false);
    }

    /**
     * Label tipe notifikasi
     */
    public function getTipeLabelAttribute(): string
    {
        return match ($this->tipe) {
            'jadwal_baru' => 'Jadwal Baru',
            'jadwal_berubah' => 'Jadwal Berubah',
            'jadwal_dibatalkan' => 'Jadwal Dibatalkan',
            'reschedule_diajukan' => 'Reschedule Diajukan',
            'reschedule_disetujui' => 'Reschedule Disetujui',
            'reschedule_ditolak' => 'Reschedule Ditolak',
            'peringatan_jam_terbang' => 'Peringatan Jam Terbang',
            'peringatan_maintenance' => 'Peringatan Maintenance',
            'pengumuman' => 'Pengumuman',
            default => 'Notifikasi',
        };
    }
}

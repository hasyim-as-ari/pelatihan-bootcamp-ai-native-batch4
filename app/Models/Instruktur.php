<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Instruktur extends Model
{
    protected $table = 'instruktur';

    protected $fillable = [
        'user_id',
        'nidn',
        'nama',
        'no_telepon',
        'lisensi',
        'max_jam_terbang_harian',
        'total_jam_terbang',
        'status',
        'catatan',
    ];

    protected $casts = [
        'max_jam_terbang_harian' => 'decimal:2',
        'total_jam_terbang' => 'decimal:2',
    ];

    /**
     * Relasi ke user account
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Jadwal penerbangan instruktur
     */
    public function jadwalPenerbangan(): HasMany
    {
        return $this->hasMany(JadwalPenerbangan::class);
    }

    /**
     * Flight log instruktur
     */
    public function flightLog(): HasMany
    {
        return $this->hasMany(FlightLog::class);
    }

    /**
     * Cek apakah instruktur available pada tanggal dan slot tertentu
     */
    public function isAvailable(string $tanggal, string $jamMulai, string $jamSelesai, ?int $excludeJadwalId = null): bool
    {
        $query = $this->jadwalPenerbangan()
            ->where('tanggal', $tanggal)
            ->whereNotIn('status', ['cancelled', 'rescheduled'])
            ->where(function ($q) use ($jamMulai, $jamSelesai) {
                $q->where(function ($q2) use ($jamMulai, $jamSelesai) {
                    $q2->where('jam_mulai', '<', $jamSelesai)
                        ->where('jam_selesai', '>', $jamMulai);
                });
            });

        if ($excludeJadwalId) {
            $query->where('id', '!=', $excludeJadwalId);
        }

        return $query->doesntExist();
    }

    /**
     * Hitung total jam terbang pada tanggal tertentu
     */
    public function totalJamTerbangPadaTanggal(string $tanggal): float
    {
        return $this->flightLog()
            ->where('tanggal', $tanggal)
            ->where('status', 'completed')
            ->sum('durasi_terbang');
    }

    /**
     * Scope instruktur aktif
     */
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }
}

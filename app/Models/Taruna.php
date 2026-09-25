<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Taruna extends Model
{
    protected $table = 'taruna';

    protected $attributes = [
        'total_jam_terbang' => 0.00,
        'kuota_jam_terbang' => 0.00,
        'sisa_kuota_jam_terbang' => 0.00,
        'max_jam_terbang_harian' => 4.00,
        'status' => 'active',
    ];

    protected $fillable = [
        'user_id',
        'nim',
        'nama',
        'no_telepon',
        'angkatan',
        'batch',
        'status_batch',
        'program_study',
        'modul_penerbangan',
        'total_jam_terbang',
        'kuota_jam_terbang',
        'sisa_kuota_jam_terbang',
        'max_jam_terbang_harian',
        'status',
        'catatan',
    ];

    protected $casts = [
        'batch' => 'integer',
        'total_jam_terbang' => 'decimal:2',
        'kuota_jam_terbang' => 'decimal:2',
        'sisa_kuota_jam_terbang' => 'decimal:2',
        'max_jam_terbang_harian' => 'decimal:2',
    ];

    /**
     * Alias accessor & mutator agar $taruna->program_studi juga berfungsi
     */
    public function getProgramStudiAttribute(): ?string
    {
        return $this->program_study;
    }

    public function setProgramStudiAttribute(?string $value): void
    {
        $this->attributes['program_study'] = $value;
    }

    /**
     * Relasi ke user account
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke master modul penerbangan (1 siswa dapat 1 atau lebih modul)
     */
    public function modulPenerbangan(): BelongsToMany
    {
        return $this->belongsToMany(
            ModulPenerbangan::class,
            'taruna_modul_penerbangan',
            'taruna_id',
            'modul_penerbangan_id'
        )->withTimestamps();
    }

    /**
     * Sinkronisasi string kolom modul_penerbangan dari relasi modulPenerbangan
     */
    public function syncModulPenerbanganString(): void
    {
        $modules = $this->modulPenerbangan()->pluck('kode_modul')->filter()->all();
        if (empty($modules)) {
            $modules = $this->modulPenerbangan()->pluck('nama_modul')->all();
        }
        $this->modul_penerbangan = !empty($modules) ? implode(', ', $modules) : null;
        $this->saveQuietly();
    }

    /**
     * Jadwal penerbangan taruna
     */
    public function jadwalPenerbangan(): HasMany
    {
        return $this->hasMany(JadwalPenerbangan::class);
    }

    /**
     * Flight log taruna
     */
    public function flightLog(): HasMany
    {
        return $this->hasMany(FlightLog::class);
    }

    /**
     * Cek apakah taruna available pada tanggal dan slot tertentu
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
     * Scope taruna aktif
     */
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }
}

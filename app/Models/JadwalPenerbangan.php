<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JadwalPenerbangan extends Model
{
    protected $table = 'jadwal_penerbangan';

    protected $fillable = [
        'kode_jadwal',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'taruna_id',
        'instruktur_id',
        'pesawat_id',
        'rute_area_latihan',
        'modul_penerbangan',
        'status',
        'catatan',
        'created_by',
        'approved_by',
        'published_at',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'published_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (JadwalPenerbangan $jadwal) {
            if (empty($jadwal->kode_jadwal)) {
                $tanggal = is_string($jadwal->tanggal) ? $jadwal->tanggal : ($jadwal->tanggal?->toDateString() ?? now()->toDateString());
                $jadwal->kode_jadwal = static::generateKodeJadwal($tanggal);
            }
        });
    }

    /**
     * Relasi ke taruna
     */
    public function taruna(): BelongsTo
    {
        return $this->belongsTo(Taruna::class);
    }

    /**
     * Relasi ke instruktur
     */
    public function instruktur(): BelongsTo
    {
        return $this->belongsTo(Instruktur::class);
    }

    /**
     * Relasi ke pesawat
     */
    public function pesawat(): BelongsTo
    {
        return $this->belongsTo(Pesawat::class);
    }

    /**
     * Relasi ke user yang membuat jadwal
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Relasi ke user yang menyetujui jadwal
     */
    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Flight log terkait jadwal ini
     */
    public function flightLog(): HasOne
    {
        return $this->hasOne(FlightLog::class);
    }

    /**
     * Pengajuan reschedule terkait jadwal ini
     */
    public function pengajuanReschedule(): HasMany
    {
        return $this->hasMany(PengajuanReschedule::class);
    }

    /**
     * Generate kode jadwal unik
     */
    public static function generateKodeJadwal(string $tanggal): string
    {
        $date = date('Ymd', strtotime($tanggal));
        $lastJadwal = static::where('kode_jadwal', 'like', "FLT-{$date}-%")
            ->orderByDesc('kode_jadwal')
            ->first();

        if ($lastJadwal) {
            $lastNumber = (int) substr($lastJadwal->kode_jadwal, -3);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        return sprintf("FLT-%s-%03d", $date, $newNumber);
    }

    /**
     * Scope jadwal hari ini
     */
    public function scopeHariIni($query)
    {
        return $query->where('tanggal', now()->toDateString());
    }

    /**
     * Scope jadwal yang sudah dipublikasikan
     */
    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at');
    }

    /**
     * Scope berdasarkan status
     */
    public function scopeByStatus($query, string $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Label status dengan warna (untuk Filament)
     */
    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'draft' => 'gray',
            'scheduled' => 'info',
            'in_flight' => 'warning',
            'completed' => 'success',
            'cancelled' => 'danger',
            'rescheduled' => 'primary',
            default => 'gray',
        };
    }

    /**
     * Label status human-readable
     */
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'draft' => 'Draft',
            'scheduled' => 'Terjadwal',
            'in_flight' => 'Sedang Terbang',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
            'rescheduled' => 'Dijadwalkan Ulang',
            default => 'Unknown',
        };
    }
}

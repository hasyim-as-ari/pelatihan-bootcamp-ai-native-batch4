<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FlightLog extends Model
{
    protected $table = 'flight_log';

    protected $fillable = [
        'jadwal_penerbangan_id',
        'taruna_id',
        'instruktur_id',
        'pesawat_id',
        'tanggal',
        'jam_takeoff',
        'jam_landing',
        'durasi_terbang',
        'status',
        'catatan_evaluasi',
        'nilai',
        'hasil_evaluasi',
        'kondisi_cuaca',
        'recorded_by',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'durasi_terbang' => 'decimal:2',
    ];

    /**
     * Relasi ke jadwal penerbangan
     */
    public function jadwalPenerbangan(): BelongsTo
    {
        return $this->belongsTo(JadwalPenerbangan::class);
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
     * Relasi ke user yang merekam log
     */
    public function recorder(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }

    /**
     * Hitung durasi terbang berdasarkan jam takeoff dan landing
     */
    public function hitungDurasiTerbang(): float
    {
        if ($this->jam_takeoff && $this->jam_landing) {
            $takeoff = strtotime($this->jam_takeoff);
            $landing = strtotime($this->jam_landing);
            $diffInSeconds = $landing - $takeoff;
            return round($diffInSeconds / 3600, 2);
        }

        return 0;
    }

    /**
     * Scope flight log yang completed
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Label hasil evaluasi
     */
    public function getHasilEvaluasiLabelAttribute(): string
    {
        return match ($this->hasil_evaluasi) {
            'lulus' => 'Lulus',
            'tidak_lulus' => 'Tidak Lulus',
            'perlu_pengulangan' => 'Perlu Pengulangan',
            default => '-',
        };
    }
}

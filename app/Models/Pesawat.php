<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pesawat extends Model
{
    protected $table = 'pesawat';

    protected $fillable = [
        'nomor_registrasi',
        'tipe_pesawat',
        'nama_pesawat',
        'total_jam_terbang',
        'jam_terbang_sebelum_maintenance',
        'status',
        'tanggal_maintenance_terakhir',
        'tanggal_maintenance_berikutnya',
        'kapasitas_penumpang',
        'catatan',
    ];

    protected $casts = [
        'total_jam_terbang' => 'decimal:2',
        'jam_terbang_sebelum_maintenance' => 'decimal:2',
        'tanggal_maintenance_terakhir' => 'date',
        'tanggal_maintenance_berikutnya' => 'date',
    ];

    /**
     * Jadwal penerbangan pesawat
     */
    public function jadwalPenerbangan(): HasMany
    {
        return $this->hasMany(JadwalPenerbangan::class);
    }

    /**
     * Flight log pesawat
     */
    public function flightLog(): HasMany
    {
        return $this->hasMany(FlightLog::class);
    }

    /**
     * Cek apakah pesawat available pada tanggal dan slot tertentu
     * Pesawat dengan status maintenance/grounded otomatis tidak available
     */
    public function isAvailable(string $tanggal, string $jamMulai, string $jamSelesai, ?int $excludeJadwalId = null): bool
    {
        // Pesawat tidak tersedia jika sedang maintenance atau grounded
        if (in_array($this->status, ['maintenance', 'grounded'])) {
            return false;
        }

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
     * Scope pesawat yang tersedia (available/in_use)
     */
    public function scopeAvailable($query)
    {
        return $query->whereIn('status', ['available', 'in_use']);
    }

    /**
     * Scope pesawat yang sedang maintenance
     */
    public function scopeMaintenance($query)
    {
        return $query->where('status', 'maintenance');
    }

    /**
     * Scope pesawat yang grounded
     */
    public function scopeGrounded($query)
    {
        return $query->where('status', 'grounded');
    }

    /**
     * Cek apakah pesawat mendekati jadwal maintenance
     */
    public function isNearMaintenance(): bool
    {
        $threshold = 10; // jam sebelum maintenance
        return $this->jam_terbang_sebelum_maintenance <= $threshold;
    }
}

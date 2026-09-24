<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengaturanSistem extends Model
{
    protected $table = 'pengaturan_sistem';

    protected $fillable = [
        'kunci',
        'nilai',
        'tipe_data',
        'grup',
        'deskripsi',
    ];

    /**
     * Ambil nilai pengaturan berdasarkan kunci
     */
    public static function getNilai(string $kunci, mixed $default = null): mixed
    {
        $pengaturan = static::where('kunci', $kunci)->first();

        if (!$pengaturan) {
            return $default;
        }

        return match ($pengaturan->tipe_data) {
            'integer' => (int) $pengaturan->nilai,
            'decimal' => (float) $pengaturan->nilai,
            'boolean' => filter_var($pengaturan->nilai, FILTER_VALIDATE_BOOLEAN),
            'json' => json_decode($pengaturan->nilai, true),
            default => $pengaturan->nilai,
        };
    }

    /**
     * Set nilai pengaturan
     */
    public static function setNilai(string $kunci, mixed $nilai): void
    {
        $pengaturan = static::where('kunci', $kunci)->first();

        if ($pengaturan) {
            $pengaturan->update(['nilai' => is_array($nilai) ? json_encode($nilai) : (string) $nilai]);
        }
    }

    /**
     * Scope berdasarkan grup
     */
    public function scopeByGrup($query, string $grup)
    {
        return $query->where('grup', $grup);
    }
}

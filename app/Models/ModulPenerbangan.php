<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ModulPenerbangan extends Model
{
    protected $table = 'modul_penerbangan';

    protected $fillable = [
        'kode_modul',
        'nama_modul',
        'lisensi_target',
        'kategori',
        'standar_jam_terbang',
        'deskripsi',
        'is_active',
    ];

    protected $casts = [
        'standar_jam_terbang' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    /**
     * Relasi ke taruna yang mengambil modul ini
     */
    public function taruna(): BelongsToMany
    {
        return $this->belongsToMany(
            Taruna::class,
            'taruna_modul_penerbangan',
            'modul_penerbangan_id',
            'taruna_id'
        )->withTimestamps();
    }
}

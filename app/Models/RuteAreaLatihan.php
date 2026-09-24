<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RuteAreaLatihan extends Model
{
    protected $table = 'rute_area_latihan';

    protected $fillable = [
        'kode_rute',
        'nama_rute',
        'kategori',
        'estimasi_durasi_jam',
        'deskripsi',
        'is_active',
    ];

    protected $casts = [
        'estimasi_durasi_jam' => 'decimal:2',
        'is_active' => 'boolean',
    ];
}

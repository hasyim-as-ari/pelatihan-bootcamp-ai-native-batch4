<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SlotWaktu extends Model
{
    protected $table = 'slot_waktu';

    protected $fillable = [
        'nama_slot',
        'jam_mulai',
        'jam_selesai',
        'durasi_jam',
        'is_active',
        'urutan',
    ];

    protected $casts = [
        'durasi_jam' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    /**
     * Scope slot aktif, urut berdasarkan jam mulai
     */
    public function scopeAktif($query)
    {
        return $query->where('is_active', true)->orderBy('urutan');
    }
}

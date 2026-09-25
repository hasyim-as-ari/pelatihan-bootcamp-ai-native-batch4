<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BriefingDebriefing extends Model
{
    protected $table = 'briefing_debriefings';

    protected $fillable = [
        'jadwal_penerbangan_id', 'instruktur_id', 'taruna_id',
        'type', 'date', 'time_start', 'time_end', 'location',
        'topics_covered', 'instructor_notes', 'student_notes',
        'performance_rating', 'cleared_for_flight', 'status',
    ];

    protected function casts(): array
    {
        return [
            'date'             => 'date',
            'cleared_for_flight' => 'boolean',
        ];
    }

    public function jadwalPenerbangan(): BelongsTo
    {
        return $this->belongsTo(JadwalPenerbangan::class, 'jadwal_penerbangan_id');
    }

    public function instruktur(): BelongsTo
    {
        return $this->belongsTo(Instruktur::class, 'instruktur_id');
    }

    public function taruna(): BelongsTo
    {
        return $this->belongsTo(Taruna::class, 'taruna_id');
    }
}

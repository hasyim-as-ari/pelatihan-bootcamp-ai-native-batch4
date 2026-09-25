<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AircraftDispatch extends Model
{
    protected $table = 'aircraft_dispatches';

    protected $fillable = [
        'dispatch_number', 'jadwal_penerbangan_id', 'pesawat_id',
        'instruktur_id', 'taruna_id', 'dispatcher_id',
        'dispatch_date', 'planned_departure', 'actual_departure', 'actual_return',
        'fuel_before_liters', 'fuel_after_liters', 'fuel_added_liters',
        'hobbs_start', 'hobbs_end', 'tach_start', 'tach_end',
        'weather_conditions', 'visibility_meters', 'wind_info', 'cloud_ceiling_ft',
        'atc_clearance_obtained', 'atc_clearance_code',
        'pre_flight_check_notes', 'post_flight_notes', 'status',
    ];

    protected function casts(): array
    {
        return [
            'dispatch_date'         => 'date',
            'atc_clearance_obtained' => 'boolean',
            'fuel_before_liters'    => 'decimal:2',
            'fuel_after_liters'     => 'decimal:2',
            'fuel_added_liters'     => 'decimal:2',
            'hobbs_start'           => 'decimal:2',
            'hobbs_end'             => 'decimal:2',
            'tach_start'            => 'decimal:2',
            'tach_end'              => 'decimal:2',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (AircraftDispatch $dispatch) {
            if (empty($dispatch->dispatch_number)) {
                $dispatch->dispatch_number = 'DSP-' . date('Ymd') . '-' . str_pad(
                    (static::whereDate('created_at', today())->count() + 1), 4, '0', STR_PAD_LEFT
                );
            }
        });
    }

    public function pesawat(): BelongsTo
    {
        return $this->belongsTo(Pesawat::class, 'pesawat_id');
    }

    public function instruktur(): BelongsTo
    {
        return $this->belongsTo(Instruktur::class, 'instruktur_id');
    }

    public function taruna(): BelongsTo
    {
        return $this->belongsTo(Taruna::class, 'taruna_id');
    }

    public function jadwalPenerbangan(): BelongsTo
    {
        return $this->belongsTo(JadwalPenerbangan::class, 'jadwal_penerbangan_id');
    }

    public function dispatcher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'dispatcher_id');
    }

    public function getFlightTimeAttribute(): ?float
    {
        if ($this->hobbs_start && $this->hobbs_end) {
            return round($this->hobbs_end - $this->hobbs_start, 2);
        }
        return null;
    }
}

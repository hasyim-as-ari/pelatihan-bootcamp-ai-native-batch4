<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FlightHoursReport extends Model
{
    protected $table = 'flight_hours_reports';

    protected $fillable = [
        'report_number', 'period_type', 'period_start', 'period_end',
        'period_year', 'period_month', 'taruna_id', 'pesawat_id',
        'total_flight_hours', 'dual_hours', 'solo_hours',
        'total_landings', 'total_flights', 'breakdown_data',
        'status', 'generated_by', 'approved_by', 'approved_at', 'notes',
    ];

    protected function casts(): array
    {
        return [
            'period_start'       => 'date',
            'period_end'         => 'date',
            'approved_at'        => 'datetime',
            'total_flight_hours' => 'decimal:2',
            'dual_hours'         => 'decimal:2',
            'solo_hours'         => 'decimal:2',
            'breakdown_data'     => 'array',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (FlightHoursReport $report) {
            if (empty($report->report_number)) {
                $report->report_number = 'FHR-' . date('Y') . '-' . str_pad(
                    static::whereYear('created_at', date('Y'))->count() + 1, 4, '0', STR_PAD_LEFT
                );
            }
        });
    }

    public function taruna(): BelongsTo
    {
        return $this->belongsTo(Taruna::class, 'taruna_id');
    }

    public function pesawat(): BelongsTo
    {
        return $this->belongsTo(Pesawat::class, 'pesawat_id');
    }

    public function generatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'generated_by');
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}

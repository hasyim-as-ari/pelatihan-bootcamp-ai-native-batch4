<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class LicenseRating extends Model
{
    protected $table = 'licenses_ratings';

    protected $fillable = [
        'code', 'name', 'type', 'description',
        'min_flight_hours', 'validity_months', 'is_active',
    ];

    protected function casts(): array
    {
        return [
            'min_flight_hours' => 'decimal:2',
            'is_active'        => 'boolean',
        ];
    }

    public function tarunas(): BelongsToMany
    {
        return $this->belongsToMany(Taruna::class, 'taruna_license', 'license_rating_id', 'taruna_id')
            ->withPivot(['issued_date', 'expiry_date', 'certificate_number', 'status', 'notes'])
            ->withTimestamps();
    }
}

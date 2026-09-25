<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

#[Fillable(['name', 'email', 'password', 'role', 'avatar', 'is_active'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Cek apakah user boleh mengakses Filament panel.
     */
    public function canAccessPanel(Panel $panel): bool
    {
        return $this->is_active;
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Relasi ke data instruktur (jika role = instruktur)
     */
    public function instruktur(): HasOne
    {
        return $this->hasOne(Instruktur::class);
    }

    /**
     * Relasi ke data taruna (jika role = taruna)
     */
    public function taruna(): HasOne
    {
        return $this->hasOne(Taruna::class);
    }

    /**
     * Notifikasi milik user
     */
    public function notifikasi(): HasMany
    {
        return $this->hasMany(Notifikasi::class);
    }

    /**
     * Notifikasi yang belum dibaca
     */
    public function notifikasiBelumDibaca(): HasMany
    {
        return $this->hasMany(Notifikasi::class)->where('dibaca', false);
    }

    /**
     * Log aktivitas milik user
     */
    public function activityLogs(): HasMany
    {
        return $this->hasMany(ActivityLog::class, 'user_id');
    }

    /**
     * Cek apakah user adalah Super Admin
     */
    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }

    /**
     * Cek apakah user adalah Admin Operasional
     */
    public function isAdminOperasional(): bool
    {
        return $this->role === 'admin_operasional';
    }

    /**
     * Cek apakah user adalah Instruktur
     */
    public function isInstruktur(): bool
    {
        return $this->role === 'instruktur';
    }

    /**
     * Cek apakah user adalah Taruna
     */
    public function isTaruna(): bool
    {
        return $this->role === 'taruna';
    }

    /**
     * Cek apakah user adalah Pimpinan
     */
    public function isPimpinan(): bool
    {
        return $this->role === 'pimpinan';
    }

    /**
     * Label human-readable untuk role
     */
    public function getRoleLabelAttribute(): string
    {
        return match ($this->role) {
            'super_admin' => 'Super Admin',
            'admin_operasional' => 'Flight Operations Admin',
            'instruktur' => 'Flight Instructor',
            'taruna' => 'Student / Cadet',
            'pimpinan' => 'Leadership / Director',
            default => 'User',
        };
    }
}

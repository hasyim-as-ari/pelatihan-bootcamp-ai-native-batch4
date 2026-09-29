<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

#[Fillable(['name', 'email', 'password', 'role', 'avatar', 'is_active'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, HasRoles, Notifiable;

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
     * Booted event to auto-sync Spatie role with role attribute.
     */
    protected static function booted(): void
    {
        static::saved(function (User $user) {
            if ($user->role && method_exists($user, 'syncRoles')) {
                try {
                    Role::firstOrCreate([
                        'name' => $user->role,
                        'guard_name' => 'web',
                    ]);
                    $user->syncRoles([$user->role]);
                } catch (\Throwable $e) {
                    // Fail gracefully if roles table not yet migrated
                }
            }
        });
    }

    /**
     * Cek apakah user adalah Super Admin
     */
    public function isSuperAdmin(): bool
    {
        return $this->hasRole('super_admin') || $this->role === 'super_admin';
    }

    /**
     * Cek apakah user adalah Admin Operasional
     */
    public function isAdminOperasional(): bool
    {
        return $this->hasRole('admin_operasional') || $this->role === 'admin_operasional';
    }

    /**
     * Cek apakah user adalah Instruktur
     */
    public function isInstruktur(): bool
    {
        return $this->hasRole('instruktur') || $this->role === 'instruktur';
    }

    /**
     * Cek apakah user adalah Taruna
     */
    public function isTaruna(): bool
    {
        return $this->hasRole('taruna') || $this->role === 'taruna';
    }

    /**
     * Cek apakah user adalah Pimpinan
     */
    public function isPimpinan(): bool
    {
        return $this->hasRole('pimpinan') || $this->role === 'pimpinan';
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

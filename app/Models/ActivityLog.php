<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivityLog extends Model
{
    use HasFactory;

    protected $table = 'activity_logs';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'action_type',
        'module_name',
        'record_id',
        'old_values',
        'new_values',
        'ip_address',
        'user_agent',
        'description',
        'created_at',
    ];

    protected function casts(): array
    {
        return [
            'old_values' => 'array',
            'new_values' => 'array',
            'created_at' => 'datetime',
        ];
    }

    /**
     * User yang melakukan aktivitas
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Helper pencatatan aktivitas umum
     */
    public static function record(
        int|string $userId,
        string $actionType,
        string $moduleName,
        string $description,
        ?int $recordId = null,
        ?array $oldValues = null,
        ?array $newValues = null,
        ?string $ipAddress = null,
        ?string $userAgent = null
    ): self {
        return self::create([
            'user_id' => $userId,
            'action_type' => $actionType,
            'module_name' => $moduleName,
            'record_id' => $recordId,
            'old_values' => $oldValues,
            'new_values' => $newValues,
            'ip_address' => $ipAddress ?? request()?->ip() ?? '127.0.0.1',
            'user_agent' => $userAgent ?? request()?->userAgent() ?? 'System',
            'description' => $description,
            'created_at' => now(),
        ]);
    }

    /**
     * Helper pencatatan aktivitas LOGIN
     */
    public static function logLogin(User|int|string $user, ?string $description = null): self
    {
        $userId = $user instanceof User ? $user->id : $user;
        $desc = $description ?? ($user instanceof User 
            ? "Pengguna {$user->name} ({$user->email}) berhasil masuk ke sistem"
            : "Pengguna ID {$userId} berhasil masuk ke sistem");

        return self::record(
            userId: $userId,
            actionType: 'LOGIN',
            moduleName: 'Authentication',
            description: $desc
        );
    }

    /**
     * Helper pencatatan aktivitas LOGOUT
     */
    public static function logLogout(User|int|string $user, ?string $description = null): self
    {
        $userId = $user instanceof User ? $user->id : $user;
        $desc = $description ?? ($user instanceof User 
            ? "Pengguna {$user->name} keluar dari sistem"
            : "Pengguna ID {$userId} keluar dari sistem");

        return self::record(
            userId: $userId,
            actionType: 'LOGOUT',
            moduleName: 'Authentication',
            description: $desc
        );
    }
}

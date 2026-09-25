<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LoginHistory extends Model
{
    protected $table = 'login_histories';

    public $timestamps = false;

    protected $fillable = [
        'user_id', 'email', 'ip_address', 'user_agent',
        'status', 'failure_reason', 'country', 'city', 'logged_at',
    ];

    protected function casts(): array
    {
        return [
            'logged_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function record(
        ?int $userId,
        string $email,
        string $status = 'success',
        ?string $failureReason = null,
        ?string $ipAddress = null,
        ?string $userAgent = null,
    ): self {
        return self::create([
            'user_id'        => $userId,
            'email'          => $email,
            'ip_address'     => $ipAddress ?? request()?->ip() ?? '127.0.0.1',
            'user_agent'     => $userAgent ?? request()?->userAgent() ?? 'System',
            'status'         => $status,
            'failure_reason' => $failureReason,
            'logged_at'      => now(),
        ]);
    }
}

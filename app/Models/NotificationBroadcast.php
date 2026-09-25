<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NotificationBroadcast extends Model
{
    protected $table = 'notification_broadcasts';

    protected $fillable = [
        'title', 'message', 'channel', 'target_role', 'target_user_ids',
        'jadwal_penerbangan_id', 'trigger_type', 'priority',
        'scheduled_at', 'sent_at', 'recipients_count', 'delivered_count',
        'failed_count', 'status', 'error_log', 'created_by',
    ];

    protected function casts(): array
    {
        return [
            'target_user_ids' => 'array',
            'scheduled_at'    => 'datetime',
            'sent_at'         => 'datetime',
        ];
    }

    public function jadwalPenerbangan(): BelongsTo
    {
        return $this->belongsTo(JadwalPenerbangan::class, 'jadwal_penerbangan_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

<?php

namespace App\Policies;

use App\Models\NotificationBroadcast;
use App\Models\User;

class NotificationBroadcastPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasRole('super_admin');
    }

    public function view(User $user, NotificationBroadcast $record): bool
    {
        return $user->hasRole('super_admin');
    }

    public function create(User $user): bool
    {
        return $user->hasRole('super_admin');
    }

    public function update(User $user, NotificationBroadcast $record): bool
    {
        return $user->hasRole('super_admin');
    }

    public function delete(User $user, NotificationBroadcast $record): bool
    {
        return $user->hasRole('super_admin');
    }
}

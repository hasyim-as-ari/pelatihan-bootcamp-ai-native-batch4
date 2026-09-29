<?php

namespace App\Policies;

use App\Models\ActivityLog;
use App\Models\User;

class ActivityLogPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['super_admin', 'admin_operasional', 'pimpinan']);
    }

    public function view(User $user, ActivityLog $record): bool
    {
        return $user->hasAnyRole(['super_admin', 'admin_operasional', 'pimpinan']);
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, ActivityLog $record): bool
    {
        return false;
    }

    public function delete(User $user, ActivityLog $record): bool
    {
        return $user->hasRole('super_admin');
    }
}

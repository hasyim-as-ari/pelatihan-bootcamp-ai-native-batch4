<?php

namespace App\Policies;

use App\Models\LoginHistory;
use App\Models\User;

class LoginHistoryPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['super_admin', 'admin_operasional', 'pimpinan']);
    }

    public function view(User $user, LoginHistory $record): bool
    {
        return $user->hasAnyRole(['super_admin', 'admin_operasional', 'pimpinan']);
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, LoginHistory $record): bool
    {
        return false;
    }

    public function delete(User $user, LoginHistory $record): bool
    {
        return $user->hasRole('super_admin');
    }
}

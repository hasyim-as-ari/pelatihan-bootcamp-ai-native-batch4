<?php

namespace App\Policies;

use App\Models\AircraftDispatch;
use App\Models\User;

class AircraftDispatchPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['super_admin', 'admin_operasional']);
    }

    public function view(User $user, AircraftDispatch $record): bool
    {
        return $user->hasAnyRole(['super_admin', 'admin_operasional']);
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['super_admin', 'admin_operasional']);
    }

    public function update(User $user, AircraftDispatch $record): bool
    {
        return $user->hasAnyRole(['super_admin', 'admin_operasional']);
    }

    public function delete(User $user, AircraftDispatch $record): bool
    {
        return $user->hasAnyRole(['super_admin', 'admin_operasional']);
    }
}

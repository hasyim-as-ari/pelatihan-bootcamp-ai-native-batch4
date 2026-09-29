<?php

namespace App\Policies;

use App\Models\Taruna;
use App\Models\User;

class TarunaPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasRole('super_admin');
    }

    public function view(User $user, Taruna $taruna): bool
    {
        return $user->hasRole('super_admin') || ($user->hasRole('taruna') && $taruna->user_id === $user->id);
    }

    public function create(User $user): bool
    {
        return $user->hasRole('super_admin');
    }

    public function update(User $user, Taruna $taruna): bool
    {
        return $user->hasRole('super_admin');
    }

    public function delete(User $user, Taruna $taruna): bool
    {
        return $user->hasRole('super_admin');
    }
}

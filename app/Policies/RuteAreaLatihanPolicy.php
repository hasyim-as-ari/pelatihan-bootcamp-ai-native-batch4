<?php

namespace App\Policies;

use App\Models\RuteAreaLatihan;
use App\Models\User;

class RuteAreaLatihanPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasRole('super_admin');
    }

    public function view(User $user, RuteAreaLatihan $ruteAreaLatihan): bool
    {
        return $user->hasRole('super_admin');
    }

    public function create(User $user): bool
    {
        return $user->hasRole('super_admin');
    }

    public function update(User $user, RuteAreaLatihan $ruteAreaLatihan): bool
    {
        return $user->hasRole('super_admin');
    }

    public function delete(User $user, RuteAreaLatihan $ruteAreaLatihan): bool
    {
        return $user->hasRole('super_admin');
    }
}

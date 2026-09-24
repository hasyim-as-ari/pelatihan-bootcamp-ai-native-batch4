<?php

namespace App\Policies;

use App\Models\Taruna;
use App\Models\User;

class TarunaPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Taruna $taruna): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->isSuperAdmin() || $user->isAdminOperasional();
    }

    public function update(User $user, Taruna $taruna): bool
    {
        return $user->isSuperAdmin() || $user->isAdminOperasional();
    }

    public function delete(User $user, Taruna $taruna): bool
    {
        return $user->isSuperAdmin() || $user->isAdminOperasional();
    }
}

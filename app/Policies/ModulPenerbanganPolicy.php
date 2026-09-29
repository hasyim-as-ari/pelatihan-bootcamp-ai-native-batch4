<?php

namespace App\Policies;

use App\Models\ModulPenerbangan;
use App\Models\User;

class ModulPenerbanganPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasRole('super_admin');
    }

    public function view(User $user, ModulPenerbangan $modulPenerbangan): bool
    {
        return $user->hasRole('super_admin');
    }

    public function create(User $user): bool
    {
        return $user->hasRole('super_admin');
    }

    public function update(User $user, ModulPenerbangan $modulPenerbangan): bool
    {
        return $user->hasRole('super_admin');
    }

    public function delete(User $user, ModulPenerbangan $modulPenerbangan): bool
    {
        return $user->hasRole('super_admin');
    }
}

<?php

namespace App\Policies;

use App\Models\Pesawat;
use App\Models\User;

class PesawatPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasRole('super_admin');
    }

    public function view(User $user, Pesawat $pesawat): bool
    {
        return $user->hasRole('super_admin');
    }

    public function create(User $user): bool
    {
        return $user->hasRole('super_admin');
    }

    public function update(User $user, Pesawat $pesawat): bool
    {
        return $user->hasRole('super_admin');
    }

    public function delete(User $user, Pesawat $pesawat): bool
    {
        return $user->hasRole('super_admin');
    }
}

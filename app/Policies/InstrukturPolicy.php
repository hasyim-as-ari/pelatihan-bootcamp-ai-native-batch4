<?php

namespace App\Policies;

use App\Models\Instruktur;
use App\Models\User;

class InstrukturPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasRole('super_admin');
    }

    public function view(User $user, Instruktur $instruktur): bool
    {
        return $user->hasRole('super_admin') || ($user->hasRole('instruktur') && $instruktur->user_id === $user->id);
    }

    public function create(User $user): bool
    {
        return $user->hasRole('super_admin');
    }

    public function update(User $user, Instruktur $instruktur): bool
    {
        return $user->hasRole('super_admin');
    }

    public function delete(User $user, Instruktur $instruktur): bool
    {
        return $user->hasRole('super_admin');
    }
}

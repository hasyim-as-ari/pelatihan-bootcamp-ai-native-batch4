<?php

namespace App\Policies;

use App\Models\Instruktur;
use App\Models\User;

class InstrukturPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Instruktur $instruktur): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->isSuperAdmin() || $user->isAdminOperasional();
    }

    public function update(User $user, Instruktur $instruktur): bool
    {
        return $user->isSuperAdmin() || $user->isAdminOperasional();
    }

    public function delete(User $user, Instruktur $instruktur): bool
    {
        return $user->isSuperAdmin() || $user->isAdminOperasional();
    }
}

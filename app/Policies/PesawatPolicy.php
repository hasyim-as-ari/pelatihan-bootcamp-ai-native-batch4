<?php

namespace App\Policies;

use App\Models\Pesawat;
use App\Models\User;

class PesawatPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Pesawat $pesawat): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->isSuperAdmin() || $user->isAdminOperasional();
    }

    public function update(User $user, Pesawat $pesawat): bool
    {
        return $user->isSuperAdmin() || $user->isAdminOperasional();
    }

    public function delete(User $user, Pesawat $pesawat): bool
    {
        return $user->isSuperAdmin() || $user->isAdminOperasional();
    }
}

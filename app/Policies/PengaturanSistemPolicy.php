<?php

namespace App\Policies;

use App\Models\PengaturanSistem;
use App\Models\User;

class PengaturanSistemPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isSuperAdmin();
    }

    public function view(User $user, PengaturanSistem $pengaturan): bool
    {
        return $user->isSuperAdmin();
    }

    public function create(User $user): bool
    {
        return $user->isSuperAdmin();
    }

    public function update(User $user, PengaturanSistem $pengaturan): bool
    {
        return $user->isSuperAdmin();
    }

    public function delete(User $user, PengaturanSistem $pengaturan): bool
    {
        return $user->isSuperAdmin();
    }
}

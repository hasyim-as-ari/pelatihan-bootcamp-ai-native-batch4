<?php

namespace App\Policies;

use App\Models\JadwalPenerbangan;
use App\Models\User;

class JadwalPenerbanganPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, JadwalPenerbangan $jadwal): bool
    {
        if ($user->isSuperAdmin() || $user->isAdminOperasional() || $user->isPimpinan()) {
            return true;
        }

        if ($user->isInstruktur() && $jadwal->instruktur && $jadwal->instruktur->user_id === $user->id) {
            return true;
        }

        if ($user->isTaruna() && $jadwal->taruna && $jadwal->taruna->user_id === $user->id) {
            return true;
        }

        return false;
    }

    public function create(User $user): bool
    {
        return $user->isSuperAdmin() || $user->isAdminOperasional();
    }

    public function update(User $user, JadwalPenerbangan $jadwal): bool
    {
        return $user->isSuperAdmin() || $user->isAdminOperasional();
    }

    public function delete(User $user, JadwalPenerbangan $jadwal): bool
    {
        return $user->isSuperAdmin() || $user->isAdminOperasional();
    }
}

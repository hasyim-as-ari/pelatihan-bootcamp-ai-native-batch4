<?php

namespace App\Policies;

use App\Models\PengajuanReschedule;
use App\Models\User;

class PengajuanReschedulePolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, PengajuanReschedule $pengajuan): bool
    {
        if ($user->isSuperAdmin() || $user->isAdminOperasional() || $user->isPimpinan()) {
            return true;
        }

        return $pengajuan->pemohon_id === $user->id;
    }

    public function create(User $user): bool
    {
        return $user->isInstruktur() || $user->isTaruna() || $user->isSuperAdmin() || $user->isAdminOperasional();
    }

    public function update(User $user, PengajuanReschedule $pengajuan): bool
    {
        // Instruktur & Taruna can edit their own pending requests
        if (($user->isInstruktur() || $user->isTaruna()) && $pengajuan->pemohon_id === $user->id && $pengajuan->status === 'pending') {
            return true;
        }

        // Admins can edit to approve/reject
        return $user->isSuperAdmin() || $user->isAdminOperasional();
    }

    public function delete(User $user, PengajuanReschedule $pengajuan): bool
    {
        return $user->isSuperAdmin() || $user->isAdminOperasional();
    }
}

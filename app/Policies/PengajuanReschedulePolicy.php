<?php

namespace App\Policies;

use App\Models\PengajuanReschedule;
use App\Models\User;

class PengajuanReschedulePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['super_admin', 'admin_operasional', 'taruna']);
    }

    public function view(User $user, PengajuanReschedule $pengajuan): bool
    {
        if ($user->hasRole('super_admin') || $user->hasRole('admin_operasional') || $user->isPimpinan()) {
            return true;
        }

        return $pengajuan->pemohon_id === $user->id;
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['super_admin', 'admin_operasional', 'taruna']);
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

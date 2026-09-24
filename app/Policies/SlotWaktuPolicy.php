<?php

namespace App\Policies;

use App\Models\SlotWaktu;
use App\Models\User;

class SlotWaktuPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, SlotWaktu $slotWaktu): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->isSuperAdmin() || $user->isAdminOperasional();
    }

    public function update(User $user, SlotWaktu $slotWaktu): bool
    {
        return $user->isSuperAdmin() || $user->isAdminOperasional();
    }

    public function delete(User $user, SlotWaktu $slotWaktu): bool
    {
        return $user->isSuperAdmin() || $user->isAdminOperasional();
    }
}

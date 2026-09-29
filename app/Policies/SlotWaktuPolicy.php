<?php

namespace App\Policies;

use App\Models\SlotWaktu;
use App\Models\User;

class SlotWaktuPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasRole('super_admin');
    }

    public function view(User $user, SlotWaktu $slotWaktu): bool
    {
        return $user->hasRole('super_admin');
    }

    public function create(User $user): bool
    {
        return $user->hasRole('super_admin');
    }

    public function update(User $user, SlotWaktu $slotWaktu): bool
    {
        return $user->hasRole('super_admin');
    }

    public function delete(User $user, SlotWaktu $slotWaktu): bool
    {
        return $user->hasRole('super_admin');
    }
}

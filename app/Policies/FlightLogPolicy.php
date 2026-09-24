<?php

namespace App\Policies;

use App\Models\FlightLog;
use App\Models\User;

class FlightLogPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, FlightLog $log): bool
    {
        if ($user->isSuperAdmin() || $user->isAdminOperasional() || $user->isPimpinan()) {
            return true;
        }

        if ($user->isInstruktur() && $log->instruktur && $log->instruktur->user_id === $user->id) {
            return true;
        }

        if ($user->isTaruna() && $log->taruna && $log->taruna->user_id === $user->id) {
            return true;
        }

        return false;
    }

    public function create(User $user): bool
    {
        return $user->isSuperAdmin() || $user->isAdminOperasional() || $user->isInstruktur();
    }

    public function update(User $user, FlightLog $log): bool
    {
        if ($user->isSuperAdmin() || $user->isAdminOperasional()) {
            return true;
        }

        if ($user->isInstruktur() && $log->instruktur && $log->instruktur->user_id === $user->id) {
            return true;
        }

        return false;
    }

    public function delete(User $user, FlightLog $log): bool
    {
        return $user->isSuperAdmin() || $user->isAdminOperasional();
    }
}

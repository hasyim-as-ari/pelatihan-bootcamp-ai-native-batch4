<?php

namespace App\Policies;

use App\Models\BriefingDebriefing;
use App\Models\User;

class BriefingDebriefingPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['super_admin', 'admin_operasional', 'instruktur']);
    }

    public function view(User $user, BriefingDebriefing $record): bool
    {
        if ($user->hasRole('super_admin') || $user->hasRole('admin_operasional')) {
            return true;
        }

        if ($user->hasRole('instruktur') && $record->instruktur_id === $user->instruktur?->id) {
            return true;
        }

        return false;
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['super_admin', 'admin_operasional', 'instruktur']);
    }

    public function update(User $user, BriefingDebriefing $record): bool
    {
        if ($user->hasRole('super_admin') || $user->hasRole('admin_operasional')) {
            return true;
        }

        if ($user->hasRole('instruktur') && $record->instruktur_id === $user->instruktur?->id) {
            return true;
        }

        return false;
    }

    public function delete(User $user, BriefingDebriefing $record): bool
    {
        return $user->hasAnyRole(['super_admin', 'admin_operasional']);
    }
}

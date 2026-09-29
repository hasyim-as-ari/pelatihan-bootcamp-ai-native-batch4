<?php

namespace App\Policies;

use App\Models\LicenseRating;
use App\Models\User;

class LicenseRatingPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasRole('super_admin');
    }

    public function view(User $user, LicenseRating $licenseRating): bool
    {
        return $user->hasRole('super_admin');
    }

    public function create(User $user): bool
    {
        return $user->hasRole('super_admin');
    }

    public function update(User $user, LicenseRating $licenseRating): bool
    {
        return $user->hasRole('super_admin');
    }

    public function delete(User $user, LicenseRating $licenseRating): bool
    {
        return $user->hasRole('super_admin');
    }
}

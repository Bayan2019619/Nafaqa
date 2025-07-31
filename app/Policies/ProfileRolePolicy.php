<?php

namespace App\Policies;

use App\Models\ProfileRole;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfileRolePolicy
{
    use HandlesAuthorization;

    /**
     * Before method to give admins all permissions automatically
     */
    public function before(User $user, $ability)
    {
        if ($user->hasRole('admin')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any profile roles.
     */
    public function viewAny(User $user)
    {
        return $user->can('profileRole.view');
    }

    /**
     * Determine whether the user can view the profile role.
     */
    public function view(User $user, ProfileRole $profileRole)
    {
        // Admin already allowed by before()

        // Allow if user owns this profile
        return $user->id === $profileRole->user_id;
    }

    /**
     * Determine whether the user can create profile roles.
     */
    public function create(User $user)
    {
        // Allow only if user does not already have a profile role
        return $user->profileRole === null;
    }

    /**
     * Determine whether the user can update the profile role.
     */
    public function update(User $user, ProfileRole $profileRole)
    {
        // Owner or admin (admin handled in before)
        return $user->id === $profileRole->user_id;
    }

    /**
     * Determine whether the user can delete the profile role.
     */
    public function delete(User $user, ProfileRole $profileRole)
    {
        // Owner or admin (admin handled in before)
        return $user->id === $profileRole->user_id;
    }

    /**
     * Determine whether the user can change status (verify).
     */
    public function changeStatus(User $user, ProfileRole $profileRole)
    {
        // Only users with 'profileRole.verify' permission or admin
        return $user->can('profileRole.verify');
    }
}

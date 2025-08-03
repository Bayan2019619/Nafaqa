<?php

namespace App\Policies;

use App\Models\ProfileRole;
use App\Models\User;
use App\StatusEnum;
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
        return $user->can('profileRole.viewAny');
    }

    /**
     * Determine whether the user can view the profile role.
     */
    public function view(User $user, ProfileRole $profileRole)
    {
        return ($user->id === $profileRole->user_id || $user->can('profileRole.view'));
    }

    /**
     * Determine whether the user can create profile roles.
     */
    public function create(User $user)
    {
        return $user->profileRole === null || $user->can('profileRole.create');
    }

    /**
     * Determine whether the user can update the profile role.
     */
    public function update(User $user, ProfileRole $profileRole)
    {

        return (($user->id === $profileRole->user_id && $profileRole->status == StatusEnum::Pending) || $user->can('profileRole.update'));
    }

    /**
     * Determine whether the user can delete the profile role.
     */
    public function delete(User $user, ProfileRole $profileRole)
    {
        return ($user->can('profileRole.delete'));
    }

    /**
     * Determine whether the user can change status (verify).
     */
    public function changeStatus(User $user, ProfileRole $profileRole)
    {
        return $user->can('profileRole.status');
    }
}

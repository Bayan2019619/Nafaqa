<?php

namespace App\Policies;

use App\Models\DivorceCase;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DivorceCasePolicy
{
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
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('divorceCase.viewAny');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, DivorceCase $divorceCase): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, DivorceCase $divorceCase): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, DivorceCase $divorceCase): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, DivorceCase $divorceCase): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, DivorceCase $divorceCase): bool
    {
        return false;
    }
}

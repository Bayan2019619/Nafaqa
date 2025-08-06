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
        return $user->can('divorceCases.viewAny');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, DivorceCase $divorceCase): bool
    {
        return $user->profileRole->divorceCase === $divorceCase || $user->can('divorceCases.view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('divorceCases.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, DivorceCase $divorceCase): bool
    {
        return $user->can('divorceCases.update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, DivorceCase $divorceCase): bool
    {
        return $user->can('divorceCases.delete');
    }

        public function changeStatus(User $user, DivorceCase $divorceCase)
    {
        return $user->can('divorceCases.changeStatus');
    }
}

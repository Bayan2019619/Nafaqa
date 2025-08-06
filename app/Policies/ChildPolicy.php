<?php

namespace App\Policies;

use App\Models\Child;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ChildPolicy
{
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
        return $user->can('children.viewAny');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Child $child): bool
    {
        return $user->can('children.view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('children.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Child $child): bool
    {
        return $user->can('children.update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Child $child): bool
    {
        return $user->can('children.delete');
    }

 
}

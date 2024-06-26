<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Role;
use App\Models\User;

class RolePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view-any Role');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Role $role): bool
    {
        return $user->can('view Role');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create Role');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Role $role): bool
    {
        return $user->can('update Role');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Role $role): bool
    {
        return $user->can('delete Role');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete-any Role');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Role $role): bool
    {
        return $user->can('restore Role');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore-any Role');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Role $role): bool
    {
        return $user->can('force-delete Role');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force-delete-any Role');
    }
}

<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Committee;
use App\Models\User;

class CommitteePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view-any Committee');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Committee $committee): bool
    {
        return $user->can('view Committee');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create Committee');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Committee $committee): bool
    {
        if (!$user->can('update Committee')) {
            return false;
        };

        if ($committee->users()->where('users.id', $user->id)->first()) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Committee $committee): bool
    {
        return $user->can('delete Committee');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Committee $committee): bool
    {
        return $user->can('restore Committee');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Committee $committee): bool
    {
        return $user->can('force-delete Committee');
    }
}

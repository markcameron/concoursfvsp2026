<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\SponsorLevel;
use App\Models\User;

class SponsorLevelPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any SponsorLevel');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, SponsorLevel $sponsorlevel): bool
    {
        return $user->checkPermissionTo('view SponsorLevel');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create SponsorLevel');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, SponsorLevel $sponsorlevel): bool
    {
        return $user->checkPermissionTo('update SponsorLevel');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, SponsorLevel $sponsorlevel): bool
    {
        return $user->checkPermissionTo('delete SponsorLevel');
    }

    /**
     * Determine whether the user can delete any models.
     */
    public function deleteAny(User $user): bool
    {
        return $user->checkPermissionTo('delete-any SponsorLevel');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, SponsorLevel $sponsorlevel): bool
    {
        return $user->checkPermissionTo('restore SponsorLevel');
    }

    /**
     * Determine whether the user can restore any models.
     */
    public function restoreAny(User $user): bool
    {
        return $user->checkPermissionTo('restore-any SponsorLevel');
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(User $user, SponsorLevel $sponsorlevel): bool
    {
        return $user->checkPermissionTo('{{ replicatePermission }}');
    }

    /**
     * Determine whether the user can reorder the models.
     */
    public function reorder(User $user): bool
    {
        return $user->checkPermissionTo('{{ reorderPermission }}');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, SponsorLevel $sponsorlevel): bool
    {
        return $user->checkPermissionTo('force-delete SponsorLevel');
    }

    /**
     * Determine whether the user can permanently delete any models.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->checkPermissionTo('force-delete-any SponsorLevel');
    }
}

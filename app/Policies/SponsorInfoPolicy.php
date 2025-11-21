<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\SponsorInfo;
use App\Models\User;

class SponsorInfoPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any SponsorInfo');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, SponsorInfo $sponsorinfo): bool
    {
        return $user->checkPermissionTo('view SponsorInfo');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create SponsorInfo');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, SponsorInfo $sponsorinfo): bool
    {
        return $user->checkPermissionTo('update SponsorInfo');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, SponsorInfo $sponsorinfo): bool
    {
        return $user->checkPermissionTo('delete SponsorInfo');
    }

    /**
     * Determine whether the user can delete any models.
     */
    public function deleteAny(User $user): bool
    {
        return $user->checkPermissionTo('delete-any SponsorInfo');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, SponsorInfo $sponsorinfo): bool
    {
        return $user->checkPermissionTo('restore SponsorInfo');
    }

    /**
     * Determine whether the user can restore any models.
     */
    public function restoreAny(User $user): bool
    {
        return $user->checkPermissionTo('restore-any SponsorInfo');
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(User $user, SponsorInfo $sponsorinfo): bool
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
    public function forceDelete(User $user, SponsorInfo $sponsorinfo): bool
    {
        return $user->checkPermissionTo('force-delete SponsorInfo');
    }

    /**
     * Determine whether the user can permanently delete any models.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->checkPermissionTo('force-delete-any SponsorInfo');
    }
}

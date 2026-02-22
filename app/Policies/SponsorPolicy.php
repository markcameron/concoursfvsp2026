<?php

namespace App\Policies;

use App\Models\Sponsor;
use App\Models\User;

class SponsorPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any Sponsor');
    }

    public function view(User $user, Sponsor $sponsor): bool
    {
        return $user->checkPermissionTo('view Sponsor');
    }

    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create Sponsor');
    }

    public function update(User $user, Sponsor $sponsor): bool
    {
        return $user->checkPermissionTo('update Sponsor');
    }

    public function delete(User $user, Sponsor $sponsor): bool
    {
        return $user->checkPermissionTo('delete Sponsor');
    }

    public function deleteAny(User $user): bool
    {
        return $user->checkPermissionTo('delete-any Sponsor');
    }

    public function restore(User $user, Sponsor $sponsor): bool
    {
        return $user->checkPermissionTo('restore Sponsor');
    }

    public function restoreAny(User $user): bool
    {
        return $user->checkPermissionTo('restore-any Sponsor');
    }

    public function replicate(User $user, Sponsor $sponsor): bool
    {
        return $user->checkPermissionTo('replicate Sponsor');
    }

    public function reorder(User $user): bool
    {
        return $user->checkPermissionTo('reorder Sponsor');
    }

    public function forceDelete(User $user, Sponsor $sponsor): bool
    {
        return $user->checkPermissionTo('force-delete Sponsor');
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->checkPermissionTo('force-delete-any Sponsor');
    }
}

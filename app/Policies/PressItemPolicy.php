<?php

namespace App\Policies;

use App\Models\PressItem;
use App\Models\User;

class PressItemPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any PressItem');
    }

    public function view(User $user, PressItem $pressItem): bool
    {
        return $user->checkPermissionTo('view PressItem');
    }

    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create PressItem');
    }

    public function update(User $user, PressItem $pressItem): bool
    {
        return $user->checkPermissionTo('update PressItem');
    }

    public function delete(User $user, PressItem $pressItem): bool
    {
        return $user->checkPermissionTo('delete PressItem');
    }

    public function deleteAny(User $user): bool
    {
        return $user->checkPermissionTo('delete-any PressItem');
    }

    public function restore(User $user, PressItem $pressItem): bool
    {
        return $user->checkPermissionTo('restore PressItem');
    }

    public function restoreAny(User $user): bool
    {
        return $user->checkPermissionTo('restore-any PressItem');
    }

    public function replicate(User $user, PressItem $pressItem): bool
    {
        return $user->checkPermissionTo('replicate PressItem');
    }

    public function reorder(User $user): bool
    {
        return $user->checkPermissionTo('reorder PressItem');
    }

    public function forceDelete(User $user, PressItem $pressItem): bool
    {
        return $user->checkPermissionTo('force-delete PressItem');
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->checkPermissionTo('force-delete-any PressItem');
    }
}

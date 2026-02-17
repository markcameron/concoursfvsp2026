<?php

namespace App\Policies;

use App\Models\Banner;
use App\Models\User;

class BannerPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any Banner');
    }

    public function view(User $user, Banner $banner): bool
    {
        return $user->checkPermissionTo('view Banner');
    }

    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create Banner');
    }

    public function update(User $user, Banner $banner): bool
    {
        return $user->checkPermissionTo('update Banner');
    }

    public function delete(User $user, Banner $banner): bool
    {
        return $user->checkPermissionTo('delete Banner');
    }

    public function deleteAny(User $user): bool
    {
        return $user->checkPermissionTo('delete-any Banner');
    }

    public function restore(User $user, Banner $banner): bool
    {
        return $user->checkPermissionTo('restore Banner');
    }

    public function restoreAny(User $user): bool
    {
        return $user->checkPermissionTo('restore-any Banner');
    }

    public function forceDelete(User $user, Banner $banner): bool
    {
        return $user->checkPermissionTo('force-delete Banner');
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->checkPermissionTo('force-delete-any Banner');
    }
}

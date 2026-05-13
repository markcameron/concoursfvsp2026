<?php

namespace App\Policies;

use App\Models\Photo;
use App\Models\User;

class PhotoPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any Photo');
    }

    public function view(User $user, Photo $photo): bool
    {
        return $user->checkPermissionTo('view Photo');
    }

    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create Photo');
    }

    public function update(User $user, Photo $photo): bool
    {
        return $user->checkPermissionTo('update Photo');
    }

    public function delete(User $user, Photo $photo): bool
    {
        return $user->checkPermissionTo('delete Photo');
    }

    public function deleteAny(User $user): bool
    {
        return $user->checkPermissionTo('delete-any Photo');
    }

    public function restore(User $user, Photo $photo): bool
    {
        return $user->checkPermissionTo('restore Photo');
    }

    public function restoreAny(User $user): bool
    {
        return $user->checkPermissionTo('restore-any Photo');
    }

    public function replicate(User $user, Photo $photo): bool
    {
        return $user->checkPermissionTo('replicate Photo');
    }

    public function reorder(User $user): bool
    {
        return $user->checkPermissionTo('reorder Photo');
    }

    public function forceDelete(User $user, Photo $photo): bool
    {
        return $user->checkPermissionTo('force-delete Photo');
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->checkPermissionTo('force-delete-any Photo');
    }
}

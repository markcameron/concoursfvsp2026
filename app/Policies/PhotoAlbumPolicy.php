<?php

namespace App\Policies;

use App\Models\PhotoAlbum;
use App\Models\User;

class PhotoAlbumPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any PhotoAlbum');
    }

    public function view(User $user, PhotoAlbum $photoAlbum): bool
    {
        return $user->checkPermissionTo('view PhotoAlbum');
    }

    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create PhotoAlbum');
    }

    public function update(User $user, PhotoAlbum $photoAlbum): bool
    {
        return $user->checkPermissionTo('update PhotoAlbum');
    }

    public function delete(User $user, PhotoAlbum $photoAlbum): bool
    {
        return $user->checkPermissionTo('delete PhotoAlbum');
    }

    public function deleteAny(User $user): bool
    {
        return $user->checkPermissionTo('delete-any PhotoAlbum');
    }

    public function restore(User $user, PhotoAlbum $photoAlbum): bool
    {
        return $user->checkPermissionTo('restore PhotoAlbum');
    }

    public function restoreAny(User $user): bool
    {
        return $user->checkPermissionTo('restore-any PhotoAlbum');
    }

    public function replicate(User $user, PhotoAlbum $photoAlbum): bool
    {
        return $user->checkPermissionTo('replicate PhotoAlbum');
    }

    public function reorder(User $user): bool
    {
        return $user->checkPermissionTo('reorder PhotoAlbum');
    }

    public function forceDelete(User $user, PhotoAlbum $photoAlbum): bool
    {
        return $user->checkPermissionTo('force-delete PhotoAlbum');
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->checkPermissionTo('force-delete-any PhotoAlbum');
    }
}

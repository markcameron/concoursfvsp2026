<?php

namespace App\Policies;

use App\Models\QrCode;
use App\Models\User;

class QrCodePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any QrCode');
    }

    public function view(User $user, QrCode $qrCode): bool
    {
        return $user->checkPermissionTo('view QrCode');
    }

    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create QrCode');
    }

    public function update(User $user, QrCode $qrCode): bool
    {
        return $user->checkPermissionTo('update QrCode');
    }

    public function delete(User $user, QrCode $qrCode): bool
    {
        return $user->checkPermissionTo('delete QrCode');
    }

    public function deleteAny(User $user): bool
    {
        return $user->checkPermissionTo('delete-any QrCode');
    }

    public function restore(User $user, QrCode $qrCode): bool
    {
        return $user->checkPermissionTo('restore QrCode');
    }

    public function restoreAny(User $user): bool
    {
        return $user->checkPermissionTo('restore-any QrCode');
    }

    public function forceDelete(User $user, QrCode $qrCode): bool
    {
        return $user->checkPermissionTo('force-delete QrCode');
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->checkPermissionTo('force-delete-any QrCode');
    }
}

<?php

namespace App\Policies;

use App\Models\DiaporamaModerationLog;
use App\Models\User;

class DiaporamaModerationLogPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any DiaporamaModerationLog');
    }

    public function view(User $user, DiaporamaModerationLog $diaporamaModerationLog): bool
    {
        return $user->checkPermissionTo('view DiaporamaModerationLog');
    }

    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create DiaporamaModerationLog');
    }

    public function update(User $user, DiaporamaModerationLog $diaporamaModerationLog): bool
    {
        return $user->checkPermissionTo('update DiaporamaModerationLog');
    }

    public function delete(User $user, DiaporamaModerationLog $diaporamaModerationLog): bool
    {
        return $user->checkPermissionTo('delete DiaporamaModerationLog');
    }

    public function deleteAny(User $user): bool
    {
        return $user->checkPermissionTo('delete-any DiaporamaModerationLog');
    }

    public function restore(User $user, DiaporamaModerationLog $diaporamaModerationLog): bool
    {
        return $user->checkPermissionTo('restore DiaporamaModerationLog');
    }

    public function restoreAny(User $user): bool
    {
        return $user->checkPermissionTo('restore-any DiaporamaModerationLog');
    }

    public function replicate(User $user, DiaporamaModerationLog $diaporamaModerationLog): bool
    {
        return $user->checkPermissionTo('replicate DiaporamaModerationLog');
    }

    public function reorder(User $user): bool
    {
        return $user->checkPermissionTo('reorder DiaporamaModerationLog');
    }

    public function forceDelete(User $user, DiaporamaModerationLog $diaporamaModerationLog): bool
    {
        return $user->checkPermissionTo('force-delete DiaporamaModerationLog');
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->checkPermissionTo('force-delete-any DiaporamaModerationLog');
    }
}

<?php

namespace App\Policies;

use App\Models\DiaporamaReport;
use App\Models\User;

class DiaporamaReportPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any DiaporamaReport');
    }

    public function view(User $user, DiaporamaReport $diaporamaReport): bool
    {
        return $user->checkPermissionTo('view DiaporamaReport');
    }

    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create DiaporamaReport');
    }

    public function update(User $user, DiaporamaReport $diaporamaReport): bool
    {
        return $user->checkPermissionTo('update DiaporamaReport');
    }

    public function delete(User $user, DiaporamaReport $diaporamaReport): bool
    {
        return $user->checkPermissionTo('delete DiaporamaReport');
    }

    public function deleteAny(User $user): bool
    {
        return $user->checkPermissionTo('delete-any DiaporamaReport');
    }

    public function restore(User $user, DiaporamaReport $diaporamaReport): bool
    {
        return $user->checkPermissionTo('restore DiaporamaReport');
    }

    public function restoreAny(User $user): bool
    {
        return $user->checkPermissionTo('restore-any DiaporamaReport');
    }

    public function replicate(User $user, DiaporamaReport $diaporamaReport): bool
    {
        return $user->checkPermissionTo('replicate DiaporamaReport');
    }

    public function reorder(User $user): bool
    {
        return $user->checkPermissionTo('reorder DiaporamaReport');
    }

    public function forceDelete(User $user, DiaporamaReport $diaporamaReport): bool
    {
        return $user->checkPermissionTo('force-delete DiaporamaReport');
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->checkPermissionTo('force-delete-any DiaporamaReport');
    }
}

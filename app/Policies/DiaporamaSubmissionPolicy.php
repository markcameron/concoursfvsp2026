<?php

namespace App\Policies;

use App\Models\DiaporamaSubmission;
use App\Models\User;

class DiaporamaSubmissionPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any DiaporamaSubmission');
    }

    public function view(User $user, DiaporamaSubmission $diaporamaSubmission): bool
    {
        return $user->checkPermissionTo('view DiaporamaSubmission');
    }

    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create DiaporamaSubmission');
    }

    public function update(User $user, DiaporamaSubmission $diaporamaSubmission): bool
    {
        return $user->checkPermissionTo('update DiaporamaSubmission');
    }

    public function delete(User $user, DiaporamaSubmission $diaporamaSubmission): bool
    {
        return $user->checkPermissionTo('delete DiaporamaSubmission');
    }

    public function deleteAny(User $user): bool
    {
        return $user->checkPermissionTo('delete-any DiaporamaSubmission');
    }

    public function restore(User $user, DiaporamaSubmission $diaporamaSubmission): bool
    {
        return $user->checkPermissionTo('restore DiaporamaSubmission');
    }

    public function restoreAny(User $user): bool
    {
        return $user->checkPermissionTo('restore-any DiaporamaSubmission');
    }

    public function replicate(User $user, DiaporamaSubmission $diaporamaSubmission): bool
    {
        return $user->checkPermissionTo('replicate DiaporamaSubmission');
    }

    public function reorder(User $user): bool
    {
        return $user->checkPermissionTo('reorder DiaporamaSubmission');
    }

    public function forceDelete(User $user, DiaporamaSubmission $diaporamaSubmission): bool
    {
        return $user->checkPermissionTo('force-delete DiaporamaSubmission');
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->checkPermissionTo('force-delete-any DiaporamaSubmission');
    }
}

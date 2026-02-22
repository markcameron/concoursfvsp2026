<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Variable;

class VariablePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any Variable');
    }

    public function view(User $user, Variable $variable): bool
    {
        return $user->checkPermissionTo('view Variable');
    }

    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create Variable');
    }

    public function update(User $user, Variable $variable): bool
    {
        return $user->checkPermissionTo('update Variable');
    }

    public function delete(User $user, Variable $variable): bool
    {
        return $user->checkPermissionTo('delete Variable');
    }

    public function deleteAny(User $user): bool
    {
        return $user->checkPermissionTo('delete-any Variable');
    }

    public function restore(User $user, Variable $variable): bool
    {
        return $user->checkPermissionTo('restore Variable');
    }

    public function restoreAny(User $user): bool
    {
        return $user->checkPermissionTo('restore-any Variable');
    }

    public function replicate(User $user, Variable $variable): bool
    {
        return $user->checkPermissionTo('replicate Variable');
    }

    public function reorder(User $user): bool
    {
        return $user->checkPermissionTo('reorder Variable');
    }

    public function forceDelete(User $user, Variable $variable): bool
    {
        return $user->checkPermissionTo('force-delete Variable');
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->checkPermissionTo('force-delete-any Variable');
    }
}

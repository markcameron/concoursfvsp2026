<?php

namespace App\Policies;

use App\Models\ModerationSetting;
use App\Models\User;

class ModerationSettingPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any ModerationSetting');
    }

    public function view(User $user, ModerationSetting $moderationSetting): bool
    {
        return $user->checkPermissionTo('view ModerationSetting');
    }

    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create ModerationSetting');
    }

    public function update(User $user, ModerationSetting $moderationSetting): bool
    {
        return $user->checkPermissionTo('update ModerationSetting');
    }

    public function delete(User $user, ModerationSetting $moderationSetting): bool
    {
        return $user->checkPermissionTo('delete ModerationSetting');
    }

    public function deleteAny(User $user): bool
    {
        return $user->checkPermissionTo('delete-any ModerationSetting');
    }

    public function restore(User $user, ModerationSetting $moderationSetting): bool
    {
        return $user->checkPermissionTo('restore ModerationSetting');
    }

    public function restoreAny(User $user): bool
    {
        return $user->checkPermissionTo('restore-any ModerationSetting');
    }

    public function replicate(User $user, ModerationSetting $moderationSetting): bool
    {
        return $user->checkPermissionTo('replicate ModerationSetting');
    }

    public function reorder(User $user): bool
    {
        return $user->checkPermissionTo('reorder ModerationSetting');
    }

    public function forceDelete(User $user, ModerationSetting $moderationSetting): bool
    {
        return $user->checkPermissionTo('force-delete ModerationSetting');
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->checkPermissionTo('force-delete-any ModerationSetting');
    }
}

<?php

declare(strict_types=1);

namespace Modules\Theme\app\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use Modules\Theme\app\Models\Theme;
use Illuminate\Auth\Access\HandlesAuthorization;

class ThemePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('view_any:theme');
    }

    public function view(AuthUser $authUser, Theme $theme): bool
    {
        return $authUser->can('view:theme');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('create:theme');
    }

    public function update(AuthUser $authUser, Theme $theme): bool
    {
        return $authUser->can('update:theme');
    }

    public function delete(AuthUser $authUser, Theme $theme): bool
    {
        return $authUser->can('delete:theme');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('delete_any:theme');
    }

    public function restore(AuthUser $authUser, Theme $theme): bool
    {
        return $authUser->can('restore:theme');
    }

    public function forceDelete(AuthUser $authUser, Theme $theme): bool
    {
        return $authUser->can('force_delete:theme');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('force_delete_any:theme');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('restore_any:theme');
    }

    public function replicate(AuthUser $authUser, Theme $theme): bool
    {
        return $authUser->can('replicate:theme');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('reorder:theme');
    }

}
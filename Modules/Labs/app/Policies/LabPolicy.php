<?php

declare(strict_types=1);

namespace Modules\Labs\app\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use Modules\Labs\app\Models\Lab;
use Illuminate\Auth\Access\HandlesAuthorization;

class LabPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('view_any:lab');
    }

    public function view(AuthUser $authUser, Lab $lab): bool
    {
        return $authUser->can('view:lab');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('create:lab');
    }

    public function update(AuthUser $authUser, Lab $lab): bool
    {
        return $authUser->can('update:lab');
    }

    public function delete(AuthUser $authUser, Lab $lab): bool
    {
        return $authUser->can('delete:lab');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('delete_any:lab');
    }

    public function restore(AuthUser $authUser, Lab $lab): bool
    {
        return $authUser->can('restore:lab');
    }

    public function forceDelete(AuthUser $authUser, Lab $lab): bool
    {
        return $authUser->can('force_delete:lab');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('force_delete_any:lab');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('restore_any:lab');
    }

    public function replicate(AuthUser $authUser, Lab $lab): bool
    {
        return $authUser->can('replicate:lab');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('reorder:lab');
    }

}
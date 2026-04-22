<?php

declare(strict_types=1);

namespace Modules\Academic\app\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use Modules\Academic\app\Models\Department;
use Illuminate\Auth\Access\HandlesAuthorization;

class DepartmentPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('view_any:department');
    }

    public function view(AuthUser $authUser, Department $department): bool
    {
        return $authUser->can('view:department');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('create:department');
    }

    public function update(AuthUser $authUser, Department $department): bool
    {
        return $authUser->can('update:department');
    }

    public function delete(AuthUser $authUser, Department $department): bool
    {
        return $authUser->can('delete:department');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('delete_any:department');
    }

    public function restore(AuthUser $authUser, Department $department): bool
    {
        return $authUser->can('restore:department');
    }

    public function forceDelete(AuthUser $authUser, Department $department): bool
    {
        return $authUser->can('force_delete:department');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('force_delete_any:department');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('restore_any:department');
    }

    public function replicate(AuthUser $authUser, Department $department): bool
    {
        return $authUser->can('replicate:department');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('reorder:department');
    }

}
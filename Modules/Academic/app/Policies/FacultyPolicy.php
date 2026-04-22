<?php

declare(strict_types=1);

namespace Modules\Academic\app\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use Modules\Academic\app\Models\Faculty;
use Illuminate\Auth\Access\HandlesAuthorization;

class FacultyPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('view_any:faculty');
    }

    public function view(AuthUser $authUser, Faculty $faculty): bool
    {
        return $authUser->can('view:faculty');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('create:faculty');
    }

    public function update(AuthUser $authUser, Faculty $faculty): bool
    {
        return $authUser->can('update:faculty');
    }

    public function delete(AuthUser $authUser, Faculty $faculty): bool
    {
        return $authUser->can('delete:faculty');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('delete_any:faculty');
    }

    public function restore(AuthUser $authUser, Faculty $faculty): bool
    {
        return $authUser->can('restore:faculty');
    }

    public function forceDelete(AuthUser $authUser, Faculty $faculty): bool
    {
        return $authUser->can('force_delete:faculty');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('force_delete_any:faculty');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('restore_any:faculty');
    }

    public function replicate(AuthUser $authUser, Faculty $faculty): bool
    {
        return $authUser->can('replicate:faculty');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('reorder:faculty');
    }

}
<?php

declare(strict_types=1);

namespace Modules\Academic\app\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use Modules\Academic\app\Models\Program;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProgramPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('view_any:program');
    }

    public function view(AuthUser $authUser, Program $program): bool
    {
        return $authUser->can('view:program');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('create:program');
    }

    public function update(AuthUser $authUser, Program $program): bool
    {
        return $authUser->can('update:program');
    }

    public function delete(AuthUser $authUser, Program $program): bool
    {
        return $authUser->can('delete:program');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('delete_any:program');
    }

    public function restore(AuthUser $authUser, Program $program): bool
    {
        return $authUser->can('restore:program');
    }

    public function forceDelete(AuthUser $authUser, Program $program): bool
    {
        return $authUser->can('force_delete:program');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('force_delete_any:program');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('restore_any:program');
    }

    public function replicate(AuthUser $authUser, Program $program): bool
    {
        return $authUser->can('replicate:program');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('reorder:program');
    }

}
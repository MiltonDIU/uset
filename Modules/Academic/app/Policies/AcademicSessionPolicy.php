<?php

declare(strict_types=1);

namespace Modules\Academic\app\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use Modules\Academic\app\Models\AcademicSession;
use Illuminate\Auth\Access\HandlesAuthorization;

class AcademicSessionPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('view_any:academic_session');
    }

    public function view(AuthUser $authUser, AcademicSession $academicSession): bool
    {
        return $authUser->can('view:academic_session');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('create:academic_session');
    }

    public function update(AuthUser $authUser, AcademicSession $academicSession): bool
    {
        return $authUser->can('update:academic_session');
    }

    public function delete(AuthUser $authUser, AcademicSession $academicSession): bool
    {
        return $authUser->can('delete:academic_session');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('delete_any:academic_session');
    }

    public function restore(AuthUser $authUser, AcademicSession $academicSession): bool
    {
        return $authUser->can('restore:academic_session');
    }

    public function forceDelete(AuthUser $authUser, AcademicSession $academicSession): bool
    {
        return $authUser->can('force_delete:academic_session');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('force_delete_any:academic_session');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('restore_any:academic_session');
    }

    public function replicate(AuthUser $authUser, AcademicSession $academicSession): bool
    {
        return $authUser->can('replicate:academic_session');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('reorder:academic_session');
    }

}
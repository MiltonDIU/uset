<?php

declare(strict_types=1);

namespace Modules\Academic\app\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User as AuthUser;
use Modules\Academic\app\Models\FacultyMember;

class FacultyMemberPolicy
{
    use HandlesAuthorization;

    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('view_any:faculty_member');
    }

    public function view(AuthUser $authUser, FacultyMember $facultyMember): bool
    {
        return $authUser->can('view:faculty_member');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('create:faculty_member');
    }

    public function update(AuthUser $authUser, FacultyMember $facultyMember): bool
    {
        return $authUser->can('update:faculty_member');
    }

    public function delete(AuthUser $authUser, FacultyMember $facultyMember): bool
    {
        return $authUser->can('delete:faculty_member');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('delete_any:faculty_member');
    }

    public function restore(AuthUser $authUser, FacultyMember $facultyMember): bool
    {
        return $authUser->can('restore:faculty_member');
    }

    public function forceDelete(AuthUser $authUser, FacultyMember $facultyMember): bool
    {
        return $authUser->can('force_delete:faculty_member');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('force_delete_any:faculty_member');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('restore_any:faculty_member');
    }

    public function replicate(AuthUser $authUser, FacultyMember $facultyMember): bool
    {
        return $authUser->can('replicate:faculty_member');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('reorder:faculty_member');
    }
}

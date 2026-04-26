<?php

declare(strict_types=1);

namespace Modules\Academic\app\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User as AuthUser;
use Modules\Academic\app\Models\Course;

class CoursePolicy
{
    use HandlesAuthorization;

    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('view_any:course');
    }

    public function view(AuthUser $authUser, Course $course): bool
    {
        return $authUser->can('view:course');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('create:course');
    }

    public function update(AuthUser $authUser, Course $course): bool
    {
        return $authUser->can('update:course');
    }

    public function delete(AuthUser $authUser, Course $course): bool
    {
        return $authUser->can('delete:course');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('delete_any:course');
    }

    public function restore(AuthUser $authUser, Course $course): bool
    {
        return $authUser->can('restore:course');
    }

    public function forceDelete(AuthUser $authUser, Course $course): bool
    {
        return $authUser->can('force_delete:course');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('force_delete_any:course');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('restore_any:course');
    }

    public function replicate(AuthUser $authUser, Course $course): bool
    {
        return $authUser->can('replicate:course');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('reorder:course');
    }
}

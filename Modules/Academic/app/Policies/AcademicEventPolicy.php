<?php

declare(strict_types=1);

namespace Modules\Academic\app\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use Modules\Academic\app\Models\AcademicEvent;
use Illuminate\Auth\Access\HandlesAuthorization;

class AcademicEventPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('view_any:academic_event');
    }

    public function view(AuthUser $authUser, AcademicEvent $academicEvent): bool
    {
        return $authUser->can('view:academic_event');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('create:academic_event');
    }

    public function update(AuthUser $authUser, AcademicEvent $academicEvent): bool
    {
        return $authUser->can('update:academic_event');
    }

    public function delete(AuthUser $authUser, AcademicEvent $academicEvent): bool
    {
        return $authUser->can('delete:academic_event');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('delete_any:academic_event');
    }

    public function restore(AuthUser $authUser, AcademicEvent $academicEvent): bool
    {
        return $authUser->can('restore:academic_event');
    }

    public function forceDelete(AuthUser $authUser, AcademicEvent $academicEvent): bool
    {
        return $authUser->can('force_delete:academic_event');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('force_delete_any:academic_event');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('restore_any:academic_event');
    }

    public function replicate(AuthUser $authUser, AcademicEvent $academicEvent): bool
    {
        return $authUser->can('replicate:academic_event');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('reorder:academic_event');
    }

}
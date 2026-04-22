<?php

declare(strict_types=1);

namespace Modules\Academic\app\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use Modules\Academic\app\Models\TuitionType;
use Illuminate\Auth\Access\HandlesAuthorization;

class TuitionTypePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('view_any:tuition_type');
    }

    public function view(AuthUser $authUser, TuitionType $tuitionType): bool
    {
        return $authUser->can('view:tuition_type');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('create:tuition_type');
    }

    public function update(AuthUser $authUser, TuitionType $tuitionType): bool
    {
        return $authUser->can('update:tuition_type');
    }

    public function delete(AuthUser $authUser, TuitionType $tuitionType): bool
    {
        return $authUser->can('delete:tuition_type');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('delete_any:tuition_type');
    }

    public function restore(AuthUser $authUser, TuitionType $tuitionType): bool
    {
        return $authUser->can('restore:tuition_type');
    }

    public function forceDelete(AuthUser $authUser, TuitionType $tuitionType): bool
    {
        return $authUser->can('force_delete:tuition_type');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('force_delete_any:tuition_type');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('restore_any:tuition_type');
    }

    public function replicate(AuthUser $authUser, TuitionType $tuitionType): bool
    {
        return $authUser->can('replicate:tuition_type');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('reorder:tuition_type');
    }

}
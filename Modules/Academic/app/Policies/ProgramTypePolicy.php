<?php

declare(strict_types=1);

namespace Modules\Academic\app\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use Modules\Academic\app\Models\ProgramType;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProgramTypePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('view_any:program_type');
    }

    public function view(AuthUser $authUser, ProgramType $programType): bool
    {
        return $authUser->can('view:program_type');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('create:program_type');
    }

    public function update(AuthUser $authUser, ProgramType $programType): bool
    {
        return $authUser->can('update:program_type');
    }

    public function delete(AuthUser $authUser, ProgramType $programType): bool
    {
        return $authUser->can('delete:program_type');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('delete_any:program_type');
    }

    public function restore(AuthUser $authUser, ProgramType $programType): bool
    {
        return $authUser->can('restore:program_type');
    }

    public function forceDelete(AuthUser $authUser, ProgramType $programType): bool
    {
        return $authUser->can('force_delete:program_type');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('force_delete_any:program_type');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('restore_any:program_type');
    }

    public function replicate(AuthUser $authUser, ProgramType $programType): bool
    {
        return $authUser->can('replicate:program_type');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('reorder:program_type');
    }

}
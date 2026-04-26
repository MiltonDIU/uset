<?php

declare(strict_types=1);

namespace Modules\Academic\app\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use Modules\Academic\app\Models\Committee;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommitteePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('view_any:committee');
    }

    public function view(AuthUser $authUser, Committee $committee): bool
    {
        return $authUser->can('view:committee');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('create:committee');
    }

    public function update(AuthUser $authUser, Committee $committee): bool
    {
        return $authUser->can('update:committee');
    }

    public function delete(AuthUser $authUser, Committee $committee): bool
    {
        return $authUser->can('delete:committee');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('delete_any:committee');
    }

    public function restore(AuthUser $authUser, Committee $committee): bool
    {
        return $authUser->can('restore:committee');
    }

    public function forceDelete(AuthUser $authUser, Committee $committee): bool
    {
        return $authUser->can('force_delete:committee');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('force_delete_any:committee');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('restore_any:committee');
    }

    public function replicate(AuthUser $authUser, Committee $committee): bool
    {
        return $authUser->can('replicate:committee');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('reorder:committee');
    }

}
<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use Biostate\FilamentMenuBuilder\Models\Menu;
use Illuminate\Auth\Access\HandlesAuthorization;

class MenuPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('view_any:menu');
    }

    public function view(AuthUser $authUser, Menu $menu): bool
    {
        return $authUser->can('view:menu');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('create:menu');
    }

    public function update(AuthUser $authUser, Menu $menu): bool
    {
        return $authUser->can('update:menu');
    }

    public function delete(AuthUser $authUser, Menu $menu): bool
    {
        return $authUser->can('delete:menu');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('delete_any:menu');
    }

    public function restore(AuthUser $authUser, Menu $menu): bool
    {
        return $authUser->can('restore:menu');
    }

    public function forceDelete(AuthUser $authUser, Menu $menu): bool
    {
        return $authUser->can('force_delete:menu');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('force_delete_any:menu');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('restore_any:menu');
    }

    public function replicate(AuthUser $authUser, Menu $menu): bool
    {
        return $authUser->can('replicate:menu');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('reorder:menu');
    }

}
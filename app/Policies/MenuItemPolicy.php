<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use Biostate\FilamentMenuBuilder\Models\MenuItem;
use Illuminate\Auth\Access\HandlesAuthorization;

class MenuItemPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('view_any:menu_item');
    }

    public function view(AuthUser $authUser, MenuItem $menuItem): bool
    {
        return $authUser->can('view:menu_item');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('create:menu_item');
    }

    public function update(AuthUser $authUser, MenuItem $menuItem): bool
    {
        return $authUser->can('update:menu_item');
    }

    public function delete(AuthUser $authUser, MenuItem $menuItem): bool
    {
        return $authUser->can('delete:menu_item');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('delete_any:menu_item');
    }

    public function restore(AuthUser $authUser, MenuItem $menuItem): bool
    {
        return $authUser->can('restore:menu_item');
    }

    public function forceDelete(AuthUser $authUser, MenuItem $menuItem): bool
    {
        return $authUser->can('force_delete:menu_item');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('force_delete_any:menu_item');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('restore_any:menu_item');
    }

    public function replicate(AuthUser $authUser, MenuItem $menuItem): bool
    {
        return $authUser->can('replicate:menu_item');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('reorder:menu_item');
    }

}
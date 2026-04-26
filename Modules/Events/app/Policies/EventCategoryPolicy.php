<?php

declare(strict_types=1);

namespace Modules\Events\app\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use Modules\Events\app\Models\EventCategory;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventCategoryPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('view_any:event_category');
    }

    public function view(AuthUser $authUser, EventCategory $eventCategory): bool
    {
        return $authUser->can('view:event_category');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('create:event_category');
    }

    public function update(AuthUser $authUser, EventCategory $eventCategory): bool
    {
        return $authUser->can('update:event_category');
    }

    public function delete(AuthUser $authUser, EventCategory $eventCategory): bool
    {
        return $authUser->can('delete:event_category');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('delete_any:event_category');
    }

    public function restore(AuthUser $authUser, EventCategory $eventCategory): bool
    {
        return $authUser->can('restore:event_category');
    }

    public function forceDelete(AuthUser $authUser, EventCategory $eventCategory): bool
    {
        return $authUser->can('force_delete:event_category');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('force_delete_any:event_category');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('restore_any:event_category');
    }

    public function replicate(AuthUser $authUser, EventCategory $eventCategory): bool
    {
        return $authUser->can('replicate:event_category');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('reorder:event_category');
    }

}
<?php

declare(strict_types=1);

namespace Modules\Events\app\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use Modules\Events\app\Models\Event;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('view_any:event');
    }

    public function view(AuthUser $authUser, Event $event): bool
    {
        return $authUser->can('view:event');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('create:event');
    }

    public function update(AuthUser $authUser, Event $event): bool
    {
        return $authUser->can('update:event');
    }

    public function delete(AuthUser $authUser, Event $event): bool
    {
        return $authUser->can('delete:event');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('delete_any:event');
    }

    public function restore(AuthUser $authUser, Event $event): bool
    {
        return $authUser->can('restore:event');
    }

    public function forceDelete(AuthUser $authUser, Event $event): bool
    {
        return $authUser->can('force_delete:event');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('force_delete_any:event');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('restore_any:event');
    }

    public function replicate(AuthUser $authUser, Event $event): bool
    {
        return $authUser->can('replicate:event');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('reorder:event');
    }

}
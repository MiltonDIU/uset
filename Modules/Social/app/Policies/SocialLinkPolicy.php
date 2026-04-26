<?php

declare(strict_types=1);

namespace Modules\Social\app\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use Modules\Social\app\Models\SocialLink;
use Illuminate\Auth\Access\HandlesAuthorization;

class SocialLinkPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('view_any:social_link');
    }

    public function view(AuthUser $authUser, SocialLink $socialLink): bool
    {
        return $authUser->can('view:social_link');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('create:social_link');
    }

    public function update(AuthUser $authUser, SocialLink $socialLink): bool
    {
        return $authUser->can('update:social_link');
    }

    public function delete(AuthUser $authUser, SocialLink $socialLink): bool
    {
        return $authUser->can('delete:social_link');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('delete_any:social_link');
    }

    public function restore(AuthUser $authUser, SocialLink $socialLink): bool
    {
        return $authUser->can('restore:social_link');
    }

    public function forceDelete(AuthUser $authUser, SocialLink $socialLink): bool
    {
        return $authUser->can('force_delete:social_link');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('force_delete_any:social_link');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('restore_any:social_link');
    }

    public function replicate(AuthUser $authUser, SocialLink $socialLink): bool
    {
        return $authUser->can('replicate:social_link');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('reorder:social_link');
    }

}
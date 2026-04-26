<?php

declare(strict_types=1);

namespace Modules\FAQ\app\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use Modules\FAQ\app\Models\Faq;
use Illuminate\Auth\Access\HandlesAuthorization;

class FaqPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('view_any:faq');
    }

    public function view(AuthUser $authUser, Faq $faq): bool
    {
        return $authUser->can('view:faq');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('create:faq');
    }

    public function update(AuthUser $authUser, Faq $faq): bool
    {
        return $authUser->can('update:faq');
    }

    public function delete(AuthUser $authUser, Faq $faq): bool
    {
        return $authUser->can('delete:faq');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('delete_any:faq');
    }

    public function restore(AuthUser $authUser, Faq $faq): bool
    {
        return $authUser->can('restore:faq');
    }

    public function forceDelete(AuthUser $authUser, Faq $faq): bool
    {
        return $authUser->can('force_delete:faq');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('force_delete_any:faq');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('restore_any:faq');
    }

    public function replicate(AuthUser $authUser, Faq $faq): bool
    {
        return $authUser->can('replicate:faq');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('reorder:faq');
    }

}
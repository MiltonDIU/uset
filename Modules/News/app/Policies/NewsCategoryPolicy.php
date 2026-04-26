<?php

declare(strict_types=1);

namespace Modules\News\app\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use Modules\News\app\Models\NewsCategory;
use Illuminate\Auth\Access\HandlesAuthorization;

class NewsCategoryPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('view_any:news_category');
    }

    public function view(AuthUser $authUser, NewsCategory $newsCategory): bool
    {
        return $authUser->can('view:news_category');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('create:news_category');
    }

    public function update(AuthUser $authUser, NewsCategory $newsCategory): bool
    {
        return $authUser->can('update:news_category');
    }

    public function delete(AuthUser $authUser, NewsCategory $newsCategory): bool
    {
        return $authUser->can('delete:news_category');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('delete_any:news_category');
    }

    public function restore(AuthUser $authUser, NewsCategory $newsCategory): bool
    {
        return $authUser->can('restore:news_category');
    }

    public function forceDelete(AuthUser $authUser, NewsCategory $newsCategory): bool
    {
        return $authUser->can('force_delete:news_category');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('force_delete_any:news_category');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('restore_any:news_category');
    }

    public function replicate(AuthUser $authUser, NewsCategory $newsCategory): bool
    {
        return $authUser->can('replicate:news_category');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('reorder:news_category');
    }

}
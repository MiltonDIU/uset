<?php

declare(strict_types=1);

namespace Modules\Academic\app\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User as AuthUser;
use Modules\Academic\app\Models\ResearchInterest;

class ResearchInterestPolicy
{
    use HandlesAuthorization;

    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('view_any:research_interest');
    }

    public function view(AuthUser $authUser, ResearchInterest $researchInterest): bool
    {
        return $authUser->can('view:research_interest');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('create:research_interest');
    }

    public function update(AuthUser $authUser, ResearchInterest $researchInterest): bool
    {
        return $authUser->can('update:research_interest');
    }

    public function delete(AuthUser $authUser, ResearchInterest $researchInterest): bool
    {
        return $authUser->can('delete:research_interest');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('delete_any:research_interest');
    }

    public function restore(AuthUser $authUser, ResearchInterest $researchInterest): bool
    {
        return $authUser->can('restore:research_interest');
    }

    public function forceDelete(AuthUser $authUser, ResearchInterest $researchInterest): bool
    {
        return $authUser->can('force_delete:research_interest');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('force_delete_any:research_interest');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('restore_any:research_interest');
    }

    public function replicate(AuthUser $authUser, ResearchInterest $researchInterest): bool
    {
        return $authUser->can('replicate:research_interest');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('reorder:research_interest');
    }
}

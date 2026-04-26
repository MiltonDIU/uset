<?php

namespace Modules\Social\app\Services;

use Modules\Social\app\Models\SocialLink;

class SocialService
{
    public function getActiveLinks()
    {
        return SocialLink::where('is_active', true)->orderBy('sort_order')->get();
    }
}

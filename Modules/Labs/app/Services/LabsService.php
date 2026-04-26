<?php

namespace Modules\Labs\app\Services;

use Modules\Labs\app\Models\Lab;

class LabsService
{
    public function getActiveLabs()
    {
        return Lab::where('is_active', true)->orderBy('sort_order')->get();
    }
}

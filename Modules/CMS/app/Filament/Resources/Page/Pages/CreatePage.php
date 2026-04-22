<?php

namespace Modules\CMS\app\Filament\Resources\Page\Pages;

use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Enums\Width;
use Modules\CMS\app\Filament\Resources\Page\PageResource;

class CreatePage extends CreateRecord
{
    protected static string $resource = PageResource::class;

    public function getMaxContentWidth(): Width|string|null
    {
        return Width::Full;
    }
}

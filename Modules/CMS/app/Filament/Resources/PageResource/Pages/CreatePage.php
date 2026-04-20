<?php

namespace Modules\CMS\app\Filament\Resources\PageResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\CMS\app\Filament\Resources\PageResource;

class CreatePage extends CreateRecord
{
    protected static string $resource = PageResource::class;

    public function getMaxContentWidth(): \Filament\Support\Enums\Width|string|null
    {
        return \Filament\Support\Enums\Width::Full;
    }
}

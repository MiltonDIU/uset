<?php

namespace Modules\CMS\app\Filament\Resources\Page\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\Width;
use Modules\CMS\app\Filament\Resources\Page\PageResource;

class ListPages extends ListRecords
{
    protected static string $resource = PageResource::class;

    public function getMaxContentWidth(): Width|string|null
    {
        return Width::Full;
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

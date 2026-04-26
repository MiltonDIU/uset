<?php

namespace Modules\Events\app\Filament\Resources\EventCategoryResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Modules\Events\app\Filament\Resources\EventCategoryResource;

class ListEventCategories extends ListRecords
{
    protected static string $resource = EventCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

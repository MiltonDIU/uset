<?php

namespace Modules\News\app\Filament\Resources\NewsCategoryResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Modules\News\app\Filament\Resources\NewsCategoryResource;

class ListNewsCategories extends ListRecords
{
    protected static string $resource = NewsCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

<?php

namespace Modules\Theme\app\Filament\Resources\ThemeResource\Pages;

use Modules\Theme\app\Filament\Resources\ThemeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListThemes extends ListRecords
{
    protected static string $resource = ThemeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

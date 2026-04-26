<?php

namespace Modules\Labs\app\Filament\Resources\LabResource\Pages;

use Modules\Labs\app\Filament\Resources\LabResource;
use Filament\Resources\Pages\ListRecords;

class ListLabs extends ListRecords
{
    protected static string $resource = LabResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}

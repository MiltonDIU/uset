<?php

namespace Modules\Academic\app\Filament\Resources\TuitionType\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\Academic\app\Filament\Resources\TuitionType\TuitionTypeResource;

class ListTuitionTypes extends ListRecords
{
    protected static string $resource = TuitionTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

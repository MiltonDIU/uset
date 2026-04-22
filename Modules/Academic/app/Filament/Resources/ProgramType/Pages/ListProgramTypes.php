<?php

namespace Modules\Academic\app\Filament\Resources\ProgramType\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\Academic\app\Filament\Resources\ProgramType\ProgramTypeResource;

class ListProgramTypes extends ListRecords
{
    protected static string $resource = ProgramTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

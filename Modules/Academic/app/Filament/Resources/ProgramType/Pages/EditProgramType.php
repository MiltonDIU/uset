<?php

namespace Modules\Academic\app\Filament\Resources\ProgramType\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\Academic\app\Filament\Resources\ProgramType\ProgramTypeResource;

class EditProgramType extends EditRecord
{
    protected static string $resource = ProgramTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

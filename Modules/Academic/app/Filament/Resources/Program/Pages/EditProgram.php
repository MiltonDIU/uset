<?php

namespace Modules\Academic\app\Filament\Resources\Program\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\Academic\app\Filament\Resources\Program\ProgramResource;

class EditProgram extends EditRecord
{
    protected static string $resource = ProgramResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

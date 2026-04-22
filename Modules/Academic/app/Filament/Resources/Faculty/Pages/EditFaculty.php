<?php

namespace Modules\Academic\app\Filament\Resources\Faculty\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\Academic\app\Filament\Resources\Faculty\FacultyResource;

class EditFaculty extends EditRecord
{
    protected static string $resource = FacultyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

<?php

namespace Modules\Academic\app\Filament\Resources\FacultyMember\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Modules\Academic\app\Filament\Resources\FacultyMember\FacultyMemberResource;

class EditFacultyMember extends EditRecord
{
    protected static string $resource = FacultyMemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

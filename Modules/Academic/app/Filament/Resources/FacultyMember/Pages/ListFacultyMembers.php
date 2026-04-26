<?php

namespace Modules\Academic\app\Filament\Resources\FacultyMember\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Modules\Academic\app\Filament\Resources\FacultyMember\FacultyMemberResource;

class ListFacultyMembers extends ListRecords
{
    protected static string $resource = FacultyMemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

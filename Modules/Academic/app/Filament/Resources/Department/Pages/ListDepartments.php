<?php

namespace Modules\Academic\app\Filament\Resources\Department\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\Academic\app\Filament\Resources\Department\DepartmentResource;

class ListDepartments extends ListRecords
{
    protected static string $resource = DepartmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

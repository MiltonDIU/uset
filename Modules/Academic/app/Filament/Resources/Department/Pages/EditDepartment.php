<?php

namespace Modules\Academic\app\Filament\Resources\Department\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\Academic\app\Filament\Resources\Department\DepartmentResource;

class EditDepartment extends EditRecord
{
    protected static string $resource = DepartmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

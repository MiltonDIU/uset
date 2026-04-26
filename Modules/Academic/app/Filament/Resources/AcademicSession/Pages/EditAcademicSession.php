<?php

namespace Modules\Academic\app\Filament\Resources\AcademicSession\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Modules\Academic\app\Filament\Resources\AcademicSession\AcademicSessionResource;

class EditAcademicSession extends EditRecord
{
    protected static string $resource = AcademicSessionResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}

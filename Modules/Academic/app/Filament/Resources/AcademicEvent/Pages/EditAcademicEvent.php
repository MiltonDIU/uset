<?php

namespace Modules\Academic\app\Filament\Resources\AcademicEvent\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Modules\Academic\app\Filament\Resources\AcademicEvent\AcademicEventResource;

class EditAcademicEvent extends EditRecord
{
    protected static string $resource = AcademicEventResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}

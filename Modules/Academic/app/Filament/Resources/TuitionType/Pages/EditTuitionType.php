<?php

namespace Modules\Academic\app\Filament\Resources\TuitionType\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\Academic\app\Filament\Resources\TuitionType\TuitionTypeResource;

class EditTuitionType extends EditRecord
{
    protected static string $resource = TuitionTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

<?php

namespace Modules\Academic\app\Filament\Resources\TuitionTypeResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\Academic\app\Filament\Resources\TuitionTypeResource\TuitionTypeResource;

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

<?php

namespace Modules\Labs\app\Filament\Resources\LabResource\Pages;

use Modules\Labs\app\Filament\Resources\LabResource;
use Filament\Resources\Pages\EditRecord;

class EditLab extends EditRecord
{
    protected static string $resource = LabResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}

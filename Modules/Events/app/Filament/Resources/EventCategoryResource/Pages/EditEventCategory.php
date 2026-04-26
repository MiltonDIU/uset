<?php

namespace Modules\Events\app\Filament\Resources\EventCategoryResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Modules\Events\app\Filament\Resources\EventCategoryResource;

class EditEventCategory extends EditRecord
{
    protected static string $resource = EventCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

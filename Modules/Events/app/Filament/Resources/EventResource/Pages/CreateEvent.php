<?php

namespace Modules\Events\app\Filament\Resources\EventResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Events\app\Filament\Resources\EventResource;

class CreateEvent extends CreateRecord
{
    protected static string $resource = EventResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->id();
        return $data;
    }
}

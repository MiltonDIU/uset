<?php

namespace Modules\News\app\Filament\Resources\NewsResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\News\app\Filament\Resources\NewsResource;

class CreateNews extends CreateRecord
{
    protected static string $resource = NewsResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->id();
        return $data;
    }
}

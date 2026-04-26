<?php

namespace Modules\Events\app\Filament\Resources\EventCategoryResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Events\app\Filament\Resources\EventCategoryResource;

class CreateEventCategory extends CreateRecord
{
    protected static string $resource = EventCategoryResource::class;
}

<?php

namespace Modules\Academic\app\Filament\Resources\AcademicEvent\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Modules\Academic\app\Filament\Resources\AcademicEvent\AcademicEventResource;

class ListAcademicEvents extends ListRecords
{
    protected static string $resource = AcademicEventResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}

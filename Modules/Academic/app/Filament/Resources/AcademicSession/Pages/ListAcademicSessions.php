<?php

namespace Modules\Academic\app\Filament\Resources\AcademicSession\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Modules\Academic\app\Filament\Resources\AcademicSession\AcademicSessionResource;

class ListAcademicSessions extends ListRecords
{
    protected static string $resource = AcademicSessionResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}

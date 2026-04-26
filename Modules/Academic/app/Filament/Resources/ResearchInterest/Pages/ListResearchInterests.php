<?php

namespace Modules\Academic\app\Filament\Resources\ResearchInterest\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Modules\Academic\app\Filament\Resources\ResearchInterest\ResearchInterestResource;

class ListResearchInterests extends ListRecords
{
    protected static string $resource = ResearchInterestResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}

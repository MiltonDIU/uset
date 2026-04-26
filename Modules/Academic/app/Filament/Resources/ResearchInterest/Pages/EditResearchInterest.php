<?php

namespace Modules\Academic\app\Filament\Resources\ResearchInterest\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Modules\Academic\app\Filament\Resources\ResearchInterest\ResearchInterestResource;

class EditResearchInterest extends EditRecord
{
    protected static string $resource = ResearchInterestResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}

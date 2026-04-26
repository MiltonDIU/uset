<?php

namespace Modules\Academic\app\Filament\Resources\Committee;

namespace Modules\Academic\app\Filament\Resources\Committee\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Modules\Academic\app\Filament\Resources\Committee\CommitteeResource;

class ListCommittees extends ListRecords
{
    protected static string $resource = CommitteeResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}

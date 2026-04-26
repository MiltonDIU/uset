<?php

namespace Modules\Academic\app\Filament\Resources\Committee\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Modules\Academic\app\Filament\Resources\Committee\CommitteeResource;

class ViewCommittee extends ViewRecord
{
    protected static string $resource = CommitteeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

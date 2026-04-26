<?php

namespace Modules\Academic\app\Filament\Resources\Committee\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Modules\Academic\app\Filament\Resources\Committee\CommitteeResource;

class EditCommittee extends EditRecord
{
    protected static string $resource = CommitteeResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}

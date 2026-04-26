<?php

namespace Modules\FAQ\app\Filament\Resources\FaqResource\Pages;

use Modules\FAQ\app\Filament\Resources\FaqResource;
use Filament\Resources\Pages\EditRecord;

class EditFaq extends EditRecord
{
    protected static string $resource = FaqResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}

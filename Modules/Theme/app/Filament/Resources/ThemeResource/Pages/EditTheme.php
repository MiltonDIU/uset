<?php

namespace Modules\Theme\app\Filament\Resources\ThemeResource\Pages;

use Modules\Theme\app\Filament\Resources\ThemeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTheme extends EditRecord
{
    protected static string $resource = ThemeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

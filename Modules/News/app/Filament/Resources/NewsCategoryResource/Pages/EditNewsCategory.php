<?php

namespace Modules\News\app\Filament\Resources\NewsCategoryResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Modules\News\app\Filament\Resources\NewsCategoryResource;

class EditNewsCategory extends EditRecord
{
    protected static string $resource = NewsCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

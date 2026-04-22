<?php

namespace Modules\CMS\app\Filament\Resources\Page\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Enums\Width;
use Modules\CMS\app\Filament\Resources\Page\PageResource;

class EditPage extends EditRecord
{
    protected static string $resource = PageResource::class;

    public function getMaxContentWidth(): Width|string|null
    {
        return Width::Full;
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

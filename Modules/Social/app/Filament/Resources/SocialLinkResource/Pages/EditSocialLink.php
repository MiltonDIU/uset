<?php

namespace Modules\Social\app\Filament\Resources\SocialLinkResource\Pages;

use Modules\Social\app\Filament\Resources\SocialLinkResource;
use Filament\Resources\Pages\EditRecord;

class EditSocialLink extends EditRecord
{
    protected static string $resource = SocialLinkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}

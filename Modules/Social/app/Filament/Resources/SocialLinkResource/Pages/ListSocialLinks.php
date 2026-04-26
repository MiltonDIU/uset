<?php

namespace Modules\Social\app\Filament\Resources\SocialLinkResource\Pages;

use Modules\Social\app\Filament\Resources\SocialLinkResource;
use Filament\Resources\Pages\ListRecords;

class ListSocialLinks extends ListRecords
{
    protected static string $resource = SocialLinkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}

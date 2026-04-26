<?php

namespace Modules\Academic\app\Filament\Resources\Committee\Infolists;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CommitteeInfolist
{
    public static function schema(Schema $schema): Schema
    {
        return $schema->components([
                Section::make('Committee Details')
                    ->schema([
                        TextEntry::make('name'),
                        TextEntry::make('slug'),
                        TextEntry::make('description')
                            ->columnSpanFull(),
                        IconEntry::make('is_active')
                            ->boolean(),
                    ])
                    ->columns(2),
            ]);
    }
}

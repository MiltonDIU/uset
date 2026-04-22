<?php

namespace Modules\Theme\app\Filament\Resources\Theme\Infolists;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Modules\Theme\app\Enums\ActiveStatus;

class ThemeInfolist
{
    public static function schema(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Theme Overview')
                ->schema([
                    ImageEntry::make('thumbnail')
                        ->disk('public')
                        ->columnSpanFull(),
                    TextEntry::make('name')
                        ->weight('bold'),
                    TextEntry::make('slug'),
                    TextEntry::make('framework')
                        ->badge(),
                    TextEntry::make('is_active')
                        ->label('Status')
                        ->badge()
                        ->formatStateUsing(fn (ActiveStatus $state): string => $state->getLabel())
                        ->color(fn (ActiveStatus $state): string => $state->getColor()),
                ])
                ->columns(2),

            Section::make('Details')
                ->schema([
                    TextEntry::make('description')
                        ->columnSpanFull(),
                ]),

            Section::make('Metadata')
                ->schema([
                    TextEntry::make('created_at')
                        ->dateTime()
                        ->label('Created At'),
                    TextEntry::make('updated_at')
                        ->dateTime()
                        ->label('Last Updated'),
                ])
                ->columns(2)
                ->collapsed(),
        ]);
    }
}

<?php

namespace Modules\Academic\app\Filament\Resources\Faculty\Infolists;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Modules\Academic\app\Enums\ActiveStatus;

class FacultyInfolist
{
    public static function schema(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Faculty Details')
                ->schema([
                    TextEntry::make('name')
                        ->weight('bold'),
                    TextEntry::make('slug'),
                    TextEntry::make('code')
                        ->label('Faculty Code'),
                    TextEntry::make('is_active')
                        ->label('Status')
                        ->badge()
                        ->formatStateUsing(fn (ActiveStatus $state): string => $state->getLabel())
                        ->color(fn (ActiveStatus $state): string => $state->getColor()),
                ])
                ->columns(2),

            Section::make('Description')
                ->schema([
                    TextEntry::make('description')
                        ->prose()
                        ->html()
                        ->columnSpanFull(),
                ])
                ->collapsed(),

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

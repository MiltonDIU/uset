<?php

namespace Modules\Academic\app\Filament\Resources\TuitionType\Infolists;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Modules\Academic\app\Enums\ActiveStatus;

class TuitionTypeInfolist
{
    public static function schema(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('General Information')
                ->schema([
                    TextEntry::make('name'),
                    TextEntry::make('slug'),
                    TextEntry::make('sort_order')
                        ->label('Sort Order'),
                    TextEntry::make('is_active')
                        ->label('Status')
                        ->badge()
                        ->formatStateUsing(fn (ActiveStatus $state): string => $state->getLabel())
                        ->color(fn (ActiveStatus $state): string => $state->getColor()),
                ])
                ->columns(2),

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

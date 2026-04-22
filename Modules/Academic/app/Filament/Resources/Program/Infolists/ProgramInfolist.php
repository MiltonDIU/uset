<?php

namespace Modules\Academic\app\Filament\Resources\Program\Infolists;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Modules\Academic\app\Enums\ActiveStatus;

class ProgramInfolist
{
    public static function schema(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Program Overview')
                ->schema([
                    TextEntry::make('name')
                        ->weight('bold')
                        ->size('lg'),
                    TextEntry::make('slug')
                        ->icon('heroicon-m-link'),
                    TextEntry::make('department.name')
                        ->label('Department')
                        ->icon('heroicon-o-building-office-2'),
                    TextEntry::make('programType.name')
                        ->label('Program Type')
                        ->badge(),
                    TextEntry::make('code')
                        ->label('Program Code'),
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

            // Placeholder for future relationship tabs/sections
            Section::make('Future Context')
                ->schema([
                    TextEntry::make('id')
                        ->label('Note')
                        ->formatStateUsing(fn () => 'More relationships (Courses, Students, etc.) will be added here.')
                        ->color('gray'),
                ])
                ->compact(),

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

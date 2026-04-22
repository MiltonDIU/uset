<?php

namespace Modules\CMS\app\Filament\Resources\Page\Infolists;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PageInfolist
{
    public static function schema(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Page Overview')
                ->schema([
                    TextEntry::make('title')
                        ->weight('bold')
                        ->size('lg'),
                    TextEntry::make('slug')
                        ->icon('heroicon-m-link'),
                    TextEntry::make('template')
                        ->badge(),
                    TextEntry::make('status')
                        ->badge()
                        ->color(fn (string $state): string => match ($state) {
                            'published' => 'success',
                            'draft' => 'warning',
                            'archived' => 'danger',
                            default => 'gray',
                        }),
                ])
                ->columns(2),

            Section::make('SEO Metadata')
                ->schema([
                    TextEntry::make('meta_title'),
                    TextEntry::make('meta_description')
                        ->columnSpanFull(),
                ])
                ->columns(2)
                ->collapsed(),

            Section::make('Page Content')
                ->schema([
                    TextEntry::make('content')
                        ->formatStateUsing(fn () => 'Page Builder Content (JSON)')
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

<?php

namespace Modules\Theme\app\Filament\Resources\ThemeResource\Schemas;

use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Cache;

class ThemeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
                SpatieMediaLibraryFileUpload::make('thumbnail')
                    ->collection('thumbnail'),
                \Filament\Forms\Components\Select::make('framework')
                    ->options([
                        'bootstrap4' => 'Bootstrap 4',
                        'bootstrap5' => 'Bootstrap 5',
                        'tailwind' => 'Tailwind CSS',
                    ])
                    ->default('bootstrap4')
                    ->required(),
                Toggle::make('is_active')
                    ->label('Set as Active Theme')
                    ->afterStateUpdated(function ($state, $record) {
                        if ($state && $record) {
                            $record->activate();
                            Cache::forget('active_theme_slug');
                        }
                    })
                    ->live(),
            ]);
    }
}

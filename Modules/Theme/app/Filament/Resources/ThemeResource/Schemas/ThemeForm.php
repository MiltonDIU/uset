<?php

namespace Modules\Theme\app\Filament\Resources\ThemeResource\Schemas;

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
                TextInput::make('thumbnail'),
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

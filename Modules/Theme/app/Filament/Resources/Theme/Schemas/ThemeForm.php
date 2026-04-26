<?php

namespace Modules\Theme\app\Filament\Resources\Theme\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Components\Section;
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
                Select::make('framework')
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

                Section::make('Brand Colors')
                    ->description('Manage primary and secondary brand colors.')
                    ->schema([
                        ColorPicker::make('settings.primary_color')
                            ->label('Primary Color')
                            ->default('#008558')
                            ->helperText('Default: #008558'),
                        ColorPicker::make('settings.primary_dark_color')
                            ->label('Primary Dark')
                            ->default('#00724a')
                            ->helperText('Default: #00724a'),
                        ColorPicker::make('settings.primary_light_color')
                            ->label('Primary Light')
                            ->default('#66b59a')
                            ->helperText('Default: #66b59a'),
                        ColorPicker::make('settings.accent_color')
                            ->label('Accent Color')
                            ->default('#ffc107')
                            ->helperText('Default: #ffc107'),
                        ColorPicker::make('settings.secondary_color')
                            ->label('Secondary Background')
                            ->default('#f8f9fa')
                            ->helperText('Default: #f8f9fa'),
                        ColorPicker::make('settings.body_text_color')
                            ->label('Body Text Color')
                            ->default('#333333')
                            ->helperText('Default: #333333'),
                    ])
                    ->columns(3),

                Section::make('Logos & Branding')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('main_logo')
                            ->collection('main_logo')
                            ->label('Main Logo (Header)')
                            ->image(),
                        SpatieMediaLibraryFileUpload::make('footer_logo')
                            ->collection('footer_logo')
                            ->label('Footer Logo')
                            ->image(),
                        SpatieMediaLibraryFileUpload::make('favicon')
                            ->collection('favicon')
                            ->label('Favicon')
                            ->image(),
                    ])
                    ->columns(3),
            ]);
    }
}

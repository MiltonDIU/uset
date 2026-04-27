<?php

namespace Modules\Theme\app\Filament\Resources\Theme\Schemas;

use Biostate\FilamentMenuBuilder\Models\Menu;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Cache;

class ThemeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Tabs::make('Theme Settings')
                    ->tabs([
                        Tab::make('General')
                            ->icon('heroicon-o-cog-6-tooth')
                            ->schema([
                                Section::make()
                                    ->schema([
                                        TextInput::make('name')
                                            ->required(),
                                        TextInput::make('slug')
                                            ->required(),
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
                                        Textarea::make('description')
                                            ->columnSpanFull(),
                                        SpatieMediaLibraryFileUpload::make('thumbnail')
                                            ->collection('thumbnail')
                                            ->columnSpanFull(),
                                    ])->columns(2),
                            ]),

                        Tab::make('Branding')
                            ->icon('heroicon-o-paint-brush')
                            ->schema([
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
                                        ColorPicker::make('settings.success_color')
                                            ->label('Success/Green Color')
                                            ->default('#28a745')
                                            ->helperText('Default: #28a745'),
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
                            ]),

                        Tab::make('Header')
                            ->icon('heroicon-o-view-columns')
                            ->schema([
                                Section::make('Header Configuration')
                                    ->schema([
                                        TextInput::make('settings.header_apply_now_text')
                                            ->label('Apply Now Text')
                                            ->default('Apply Now'),
                                        TextInput::make('settings.header_apply_now_url')
                                            ->label('Apply Now URL')
                                            ->placeholder('https://...'),
                                        Toggle::make('settings.header_show_apply_now')
                                            ->label('Show Apply Now Button')
                                            ->default(true),
                                        Select::make('settings.header_menu_slug')
                                            ->label('Main Menu')
                                            ->options(fn () => Menu::pluck('name', 'slug'))
                                            ->default('main-menu'),
                                    ])
                                    ->columns(2),
                            ]),

                        Tab::make('Footer')
                            ->icon('heroicon-o-queue-list')
                            ->schema([
                                Section::make('Footer Configuration')
                                    ->schema([
                                        TextInput::make('settings.footer_university_name')
                                            ->label('University Name (Footer)')
                                            ->default('University of Skill Enrichment and Technology (USET)')
                                            ->columnSpanFull(),

                                        Repeater::make('settings.footer_columns')
                                            ->label('Footer Columns')
                                            ->schema([
                                                Select::make('width')
                                                    ->label('Column Width')
                                                    ->options([
                                                        'col-lg-2' => '1/6 (Small)',
                                                        'col-lg-3' => '1/4 (Standard)',
                                                        'col-lg-4' => '1/3 (Large)',
                                                        'col-lg-5' => '5/12',
                                                        'col-lg-6' => '1/2 (Half)',
                                                        'col-lg-12' => 'Full Width',
                                                    ])
                                                    ->default('col-lg-3')
                                                    ->required(),

                                                Repeater::make('widgets')
                                                    ->label('Widgets')
                                                    ->schema([
                                                        Select::make('type')
                                                            ->label('Type')
                                                            ->options([
                                                                'about' => 'About (Logo + Info)',
                                                                'menu' => 'Menu Selection',
                                                                'contact' => 'Contact Info',
                                                                'social' => 'Social Links',
                                                                'text' => 'Custom Text',
                                                            ])
                                                            ->required()
                                                            ->live(),
                                                        TextInput::make('title')
                                                            ->label('Title')
                                                            ->visible(fn ($get) => in_array($get('type'), ['menu', 'contact', 'text', 'social'])),

                                                        // Conditional Fields
                                                        Textarea::make('description')
                                                            ->label('Description')
                                                            ->visible(fn ($get) => $get('type') === 'about'),

                                                        Select::make('menu_slug')
                                                            ->label('Menu')
                                                            ->options(fn () => Menu::pluck('name', 'slug'))
                                                            ->visible(fn ($get) => $get('type') === 'menu'),

                                                        TextInput::make('address')
                                                            ->label('Address')
                                                            ->visible(fn ($get) => $get('type') === 'contact'),
                                                        TextInput::make('phone')
                                                            ->label('Phone')
                                                            ->visible(fn ($get) => $get('type') === 'contact'),
                                                        TextInput::make('email')
                                                            ->label('Email')
                                                            ->visible(fn ($get) => $get('type') === 'contact'),

                                                        Textarea::make('content')
                                                            ->label('Text Content')
                                                            ->visible(fn ($get) => $get('type') === 'text'),
                                                    ])
                                                    ->collapsible()
                                                    ->collapsed()
                                                    ->itemLabel(fn (array $state): ?string => ($state['title'] ?? ($state['type'] ?? 'Widget')))
                                                    ->addActionLabel('Add Widget'),
                                            ])
                                            ->grid(2)
                                            ->collapsible()
                                            ->itemLabel(fn (array $state): ?string => 'Column ('.($state['width'] ?? 'col-lg-3').')')
                                            ->addActionLabel('Add Footer Column')
                                            ->columnSpanFull(),

                                        Section::make('Footer Bottom')
                                            ->schema([
                                                TextInput::make('settings.footer_copyright')
                                                    ->label('Copyright Text')
                                                    ->default('© '.date('Y').' University of Skill Enrichment & Technology. All Rights Reserved.'),
                                                Select::make('settings.footer_bottom_menu_slug')
                                                    ->label('Footer Bottom Menu')
                                                    ->options(fn () => Menu::pluck('name', 'slug'))
                                                    ->default('footer-bottom'),
                                            ])
                                            ->columns(2),
                                    ]),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}

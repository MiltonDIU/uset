<?php

namespace Modules\Labs\app\Filament\Resources\LabResource\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Modules\Academic\app\Models\Faculty;
use Modules\Academic\app\Models\Department;
use Modules\Academic\app\Models\Program;

class LabForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Lab Details')
                ->schema([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),

                    TextInput::make('location')
                        ->maxLength(255),

                    Textarea::make('description')
                        ->columnSpanFull(),
                ])
                ->columns(2),

            Section::make('Ownership (Polymorphic)')
                ->description('Specify if this lab belongs to a Faculty, Department, or specific Program.')
                ->schema([
                    Select::make('labbable_type')
                        ->label('Belongs To Type')
                        ->options([
                            Faculty::class => 'Faculty',
                            Department::class => 'Department',
                            Program::class => 'Program',
                        ])
                        ->live()
                        ->required(),

                    Select::make('labbable_id')
                        ->label('Target Owner')
                        ->options(function ($get) {
                            $type = $get('labbable_type');
                            if (!$type) return [];
                            return $type::all()->pluck('name', 'id');
                        })
                        ->searchable()
                        ->preload()
                        ->required()
                        ->hidden(fn ($get) => !$get('labbable_type')),
                ])
                ->columns(2),

            Section::make('Technical Specifications')
                ->schema([
                    KeyValue::make('specifications')
                        ->keyLabel('Equipment/Feature')
                        ->valueLabel('Specification')
                        ->columnSpanFull(),
                ]),

            Section::make('Settings & Gallery')
                ->schema([
                    Toggle::make('is_active')
                        ->default(true),

                    TextInput::make('sort_order')
                        ->numeric()
                        ->default(0),

                    SpatieMediaLibraryFileUpload::make('gallery')
                        ->collection('gallery')
                        ->multiple()
                        ->reorderable()
                        ->image()
                        ->imagePreviewHeight('150')
                        ->columnSpanFull(),
                ])
                ->columns(2),
        ]);
    }
}

<?php

namespace Modules\Academic\app\Filament\Resources\Faculty\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Modules\Academic\app\Models\Faculty;

class FacultyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('General Information')
                ->schema([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (string $operation, $state, $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                    TextInput::make('slug')
                        ->required()
                        ->unique(Faculty::class, 'slug', ignoreRecord: true),
                    TextInput::make('code')
                        ->maxLength(50),
                    TextInput::make('sort_order')
                        ->numeric()
                        ->default(0),
                    Toggle::make('is_active')
                        ->label('Active')
                        ->default(true),
                ])->columns(2),
            Section::make('Descriptions & Media')
                ->schema([
                    TextInput::make('short_description')
                        ->maxLength(255),
                    RichEditor::make('description'),
                    FileUpload::make('feature_image')
                        ->image()
                        ->directory('academic/faculties'),
                ]),
        ]);
    }
}

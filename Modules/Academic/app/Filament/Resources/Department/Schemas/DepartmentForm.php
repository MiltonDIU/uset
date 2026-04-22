<?php

namespace Modules\Academic\app\Filament\Resources\Department\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Modules\Academic\app\Models\Department;

class DepartmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('General Information')
                ->schema([
                    Select::make('faculty_id')
                        ->relationship('faculty', 'name')
                        ->required()
                        ->searchable()
                        ->preload(),
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (string $operation, $state, $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                    TextInput::make('slug')
                        ->required()
                        ->unique(Department::class, 'slug', ignoreRecord: true),
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
                    RichEditor::make('description'),
                    FileUpload::make('feature_image')
                        ->image()
                        ->directory('academic/departments'),
                ]),
        ]);
    }
}

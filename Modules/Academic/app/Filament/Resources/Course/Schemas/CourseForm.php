<?php

namespace Modules\Academic\app\Filament\Resources\Course\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Modules\Academic\app\Models\Course;

class CourseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Basic Information')
                ->schema([
                    Select::make('program_id')
                        ->relationship('program', 'name')
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
                        ->unique(Course::class, 'slug', ignoreRecord: true),
                    TextInput::make('code')
                        ->required()
                        ->unique(Course::class, 'code', ignoreRecord: true)
                        ->maxLength(255),
                ])->columns(2),

            Section::make('Academic Details')
                ->schema([
                    TextInput::make('credits')
                        ->numeric()
                        ->required(),
                    Select::make('type')
                        ->options([
                            'core' => 'Core',
                            'elective' => 'Elective',
                            'ged' => 'GED',
                            'lab' => 'Lab',
                        ])
                        ->default('core')
                        ->required(),
                    TextInput::make('semester_level')
                        ->placeholder('e.g. Year 1')
                        ->maxLength(255),
                    TextInput::make('sort_order')
                        ->numeric()
                        ->default(0),
                    Toggle::make('is_active')
                        ->label('Active Status')
                        ->default(true),
                ])->columns(2),

            Section::make('Additional Information')
                ->schema([
                    RichEditor::make('description')
                        ->columnSpanFull(),
                    Select::make('prerequisites')
                        ->relationship('prerequisites', 'name')
                        ->multiple()
                        ->searchable()
                        ->preload()
                        ->columnSpanFull(),
                ]),
        ]);
    }
}

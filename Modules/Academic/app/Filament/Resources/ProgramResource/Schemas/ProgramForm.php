<?php

namespace Modules\Academic\app\Filament\Resources\ProgramResource\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Modules\Academic\Models\Program;

class ProgramForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Tabs::make('Program Details')
                ->tabs([
                    Tab::make('General Information')
                        ->schema([
                            Section::make()
                                ->schema([
                                    Select::make('department_id')
                                        ->relationship('department', 'name')
                                        ->required()
                                        ->searchable()
                                        ->preload(),
                                    Select::make('program_type_id')
                                        ->relationship('programType', 'name')
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
                                        ->unique(Program::class, 'slug', ignoreRecord: true),
                                    TextInput::make('sub_title')
                                        ->maxLength(255),
                                    TextInput::make('duration')
                                        ->placeholder('e.g. 4 Years')
                                        ->maxLength(255),
                                    TextInput::make('total_semester')
                                        ->numeric(),
                                    TextInput::make('semester_duration')
                                        ->placeholder('e.g. 6 Months')
                                        ->maxLength(255),
                                    TextInput::make('sort_order')
                                        ->numeric()
                                        ->default(0),
                                    Toggle::make('is_active')
                                        ->label('Active')
                                        ->default(true),
                                ])->columns(2),
                            Section::make('Descriptions')
                                ->schema([
                                    TextInput::make('short_description')
                                        ->maxLength(255),
                                    RichEditor::make('overview'),
                                    RichEditor::make('description'),
                                ]),
                        ]),
                    Tab::make('Tuition Fees')
                        ->schema([
                            Repeater::make('tuitions')
                                ->relationship('tuitions')
                                ->schema([
                                    Select::make('tuition_type_id')
                                        ->relationship('tuitionType', 'name')
                                        ->required()
                                        ->searchable()
                                        ->preload(),
                                    TextInput::make('min_credit')
                                        ->numeric(),
                                    TextInput::make('max_credit')
                                        ->numeric(),
                                    TextInput::make('min_total_cost')
                                        ->numeric(),
                                    TextInput::make('max_total_cost')
                                        ->numeric(),
                                    TextInput::make('min_tuition_fee')
                                        ->numeric(),
                                    TextInput::make('max_tuition_fee')
                                        ->numeric(),
                                    TextInput::make('admission_fee')
                                        ->numeric(),
                                    TextInput::make('sort_order')
                                        ->numeric()
                                        ->default(0),
                                    Toggle::make('is_active')
                                        ->label('Active')
                                        ->default(true),
                                ])
                                ->columns(2)
                                ->itemLabel(fn (array $state): ?string => $state['tuition_type_id'] ?? null)
                                ->collapsible(),
                        ]),
                    Tab::make('Facilities')
                        ->schema([
                            Repeater::make('facilities')
                                ->relationship('facilities')
                                ->schema([
                                    TextInput::make('title')
                                        ->required()
                                        ->maxLength(255),
                                    TextInput::make('icon')
                                        ->placeholder('heroicon-o-check')
                                        ->maxLength(255),
                                    RichEditor::make('description')
                                        ->columnSpanFull(),
                                    FileUpload::make('image')
                                        ->image()
                                        ->directory('academic/facilities'),
                                    TextInput::make('sort_order')
                                        ->numeric()
                                        ->default(0),
                                    Toggle::make('is_active')
                                        ->label('Active')
                                        ->default(true),
                                ])
                                ->columns(2)
                                ->collapsible(),
                        ]),
                ])->columnSpanFull(),
        ]);
    }
}

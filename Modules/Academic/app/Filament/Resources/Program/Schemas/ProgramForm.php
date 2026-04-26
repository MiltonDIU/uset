<?php

namespace Modules\Academic\app\Filament\Resources\Program\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Modules\Academic\app\Models\Program;

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
                                    TextInput::make('total_credits')
                                        ->numeric(),
                                    TextInput::make('sort_order')
                                        ->numeric()
                                        ->default(0),
                                    Toggle::make('is_active')
                                        ->label('Active')
                                        ->default(true),
                                ])->columns(2),
                            Section::make('Descriptions')
                                ->schema([
                                    RichEditor::make('overview'),
                                    RichEditor::make('description'),
                                    SpatieMediaLibraryFileUpload::make('image')
                                        ->collection('program_images')
                                        ->image(),
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
                    Tab::make('Career Prospects')
                        ->schema([
                            Repeater::make('careerProspects')
                                ->relationship('careerProspects')
                                ->schema([
                                    TextInput::make('title')
                                        ->required()
                                        ->maxLength(255),
                                    RichEditor::make('description')
                                        ->columnSpanFull(),
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
                    Tab::make('Admission Requirements')
                        ->schema([
                            Repeater::make('admissionRequirements')
                                ->relationship('admissionRequirements')
                                ->schema([
                                    TextInput::make('title')
                                        ->required()
                                        ->maxLength(255),
                                    RichEditor::make('description')
                                        ->columnSpanFull(),
                                    Toggle::make('is_mandatory')
                                        ->default(true),
                                    TextInput::make('sort_order')
                                        ->numeric()
                                        ->default(0),
                                ])
                                ->columns(2)
                                ->collapsible(),
                        ]),
                    Tab::make('Curriculum')
                        ->schema([
                            Tabs::make('Curriculum Years')
                                ->tabs([
                                    Tab::make('Year 1')
                                        ->schema([
                                            static::getCurriculumRepeater('year1Courses', 'Year 1'),
                                        ]),
                                    Tab::make('Year 2')
                                        ->schema([
                                            static::getCurriculumRepeater('year2Courses', 'Year 2'),
                                        ]),
                                    Tab::make('Year 3')
                                        ->schema([
                                            static::getCurriculumRepeater('year3Courses', 'Year 3'),
                                        ]),
                                    Tab::make('Year 4')
                                        ->schema([
                                            static::getCurriculumRepeater('year4Courses', 'Year 4'),
                                        ]),
                                ]),
                        ]),
                ])->columnSpanFull(),
        ]);
    }

    protected static function getCurriculumRepeater(string $relationship, string $year): Repeater
    {
        return Repeater::make($relationship)
            ->relationship($relationship)
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, $set) => $set('slug', Str::slug($state))),
                TextInput::make('code')
                    ->required()
                    ->maxLength(255),
                TextInput::make('slug')
                    ->required()
                    ->maxLength(255),
                TextInput::make('credits')
                    ->numeric()
                    ->default(3),
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
                    ->default($year)
                    ->hidden(),
                TextInput::make('sort_order')
                    ->numeric()
                    ->default(0)
                    ->hidden(),
                Toggle::make('is_active')
                    ->label('Active Status')
                    ->default(true),
            ])
            ->columns(4)
            ->collapsible()
            ->orderColumn('sort_order')
            ->reorderableWithButtons()
            ->itemLabel(fn (array $state): ?string => ($state['code'] ?? '').' - '.($state['name'] ?? ''));
    }
}

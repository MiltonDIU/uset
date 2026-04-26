<?php

namespace Modules\Academic\app\Filament\Resources\FacultyMember\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Modules\Academic\app\Models\FacultyMember;

class FacultyMemberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Personal Information')
                ->schema([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (string $operation, $state, $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                    TextInput::make('slug')
                        ->required()
                        ->unique(FacultyMember::class, 'slug', ignoreRecord: true),
                    TextInput::make('designation')
                        ->required()
                        ->maxLength(255),
                    Select::make('department_id')
                        ->relationship('department', 'name')
                        ->required()
                        ->searchable()
                        ->preload(),
                ])->columns(2),

            Section::make('Contact & Sorting')
                ->schema([
                    TextInput::make('email')
                        ->email()
                        ->maxLength(255),
                    TextInput::make('phone')
                        ->tel()
                        ->maxLength(255),
                    TextInput::make('sort_order')
                        ->numeric()
                        ->default(0),
                    Toggle::make('is_active')
                        ->label('Active Status')
                        ->default(true),
                ])->columns(2),

            Section::make('Profile & Expertise')
                ->schema([
                    SpatieMediaLibraryFileUpload::make('profile_picture')
                        ->collection('profile_pictures')
                        ->image()
                        ->directory('academic/faculty-members')
                        ->columnSpanFull(),
                    RichEditor::make('bio')
                        ->columnSpanFull(),
                    Select::make('researchInterests')
                        ->relationship('researchInterests', 'name')
                        ->multiple()
                        ->searchable()
                        ->preload()
                        ->createOptionForm([
                            TextInput::make('name')
                                ->required()
                                ->maxLength(255)
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn ($state, $set) => $set('slug', Str::slug($state))),
                            TextInput::make('slug')
                                ->required()
                                ->unique('research_interests', 'slug')
                                ->maxLength(255),
                        ])
                        ->columnSpanFull(),
                ]),
        ]);
    }
}

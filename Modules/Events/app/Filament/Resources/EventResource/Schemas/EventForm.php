<?php

namespace Modules\Events\app\Filament\Resources\EventResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class EventForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Event Information')
                ->schema([
                    TextInput::make('title')
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn ($state, $set) => $set('slug', Str::slug($state))),

                    TextInput::make('slug')
                        ->required()
                        ->maxLength(255)
                        ->unique(ignoreRecord: true),

                    RichEditor::make('description')
                        ->columnSpanFull(),
                ])
                ->columnSpan(2),

            Section::make('Schedule & Venue')
                ->schema([
                    DatePicker::make('event_date')
                        ->required()
                        ->default(now()),

                    TimePicker::make('start_time'),

                    TimePicker::make('end_time'),

                    TextInput::make('venue')
                        ->maxLength(255),

                    TextInput::make('organizer')
                        ->maxLength(255),

                    TextInput::make('contact_person')
                        ->maxLength(255),
                ])
                ->columnSpan(1),

            Section::make('Categorization')
                ->schema([
                    Select::make('event_category_id')
                        ->relationship('category', 'name')
                        ->required()
                        ->searchable()
                        ->preload(),

                    Select::make('faculty_id')
                        ->relationship('faculty', 'name')
                        ->searchable()
                        ->preload()
                        ->live(),

                    Select::make('department_id')
                        ->relationship('department', 'name', fn ($query, $get) => 
                            $query->when($get('faculty_id'), fn ($q) => $q->where('faculty_id', $get('faculty_id')))
                        )
                        ->searchable()
                        ->preload(),

                    Select::make('status')
                        ->options([
                            'Upcoming' => 'Upcoming',
                            'Running' => 'Running',
                            'Completed' => 'Completed',
                            'Cancelled' => 'Cancelled',
                        ])
                        ->default('Upcoming'),

                    Toggle::make('is_featured')
                        ->label('Featured Event'),

                    Toggle::make('is_published')
                        ->default(true),
                ])
                ->columnSpan(1),

            Section::make('Media')
                ->schema([
                    SpatieMediaLibraryFileUpload::make('banner')
                        ->collection('banner')
                        ->image()
                        ->imageEditor()
                        ->columnSpanFull(),

                    SpatieMediaLibraryFileUpload::make('gallery')
                        ->collection('gallery')
                        ->multiple()
                        ->reorderable()
                        ->image()
                        ->imageEditor()
                        ->imagePreviewHeight('150')
                        ->columnSpanFull(),
                ])
                ->columnSpan(2),
        ])->columns(3);
    }
}

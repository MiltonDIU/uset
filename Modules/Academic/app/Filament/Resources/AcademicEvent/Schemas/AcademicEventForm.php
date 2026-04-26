<?php

namespace Modules\Academic\app\Filament\Resources\AcademicEvent\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class AcademicEventForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('academic_session_id')
                ->relationship('session', 'name')
                ->required()
                ->searchable()
                ->preload(),

            TextInput::make('title')
                ->required()
                ->maxLength(255),

            Select::make('type')
                ->options([
                    'event' => 'Event',
                    'holiday' => 'Holiday',
                    'exam' => 'Exam',
                    'admission' => 'Admission',
                    'registration' => 'Registration',
                ])
                ->default('event')
                ->required(),

            DatePicker::make('start_date')
                ->required(),

            DatePicker::make('end_date'),

            TextInput::make('location')
                ->maxLength(255),

            Toggle::make('is_holiday')
                ->default(false),

            Textarea::make('description')
                ->columnSpanFull(),
        ]);
    }
}

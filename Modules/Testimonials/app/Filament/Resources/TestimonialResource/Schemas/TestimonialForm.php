<?php

namespace Modules\Testimonials\app\Filament\Resources\TestimonialResource\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Modules\Academic\app\Models\Faculty;
use Modules\Academic\app\Models\Department;
use Modules\Academic\app\Models\Program;

class TestimonialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('General Information')
                ->schema([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),

                    TextInput::make('designation')
                        ->maxLength(255),

                    Textarea::make('quote')
                        ->required()
                        ->columnSpanFull(),
                ])
                ->columns(2),

            Section::make('Relationships (Polymorphic)')
                ->description('Link this testimonial to a Faculty, Department, or Program.')
                ->schema([
                    Select::make('testimonialable_type')
                        ->label('Type')
                        ->options([
                            Faculty::class => 'Faculty',
                            Department::class => 'Department',
                            Program::class => 'Program',
                        ])
                        ->live()
                        ->required(),

                    Select::make('testimonialable_id')
                        ->label('Target')
                        ->options(function ($get) {
                            $type = $get('testimonialable_type');
                            if (!$type) return [];
                            return $type::all()->pluck('name', 'id');
                        })
                        ->searchable()
                        ->preload()
                        ->required()
                        ->hidden(fn ($get) => !$get('testimonialable_type')),
                ])
                ->columns(2),

            Section::make('Settings & Media')
                ->schema([
                    Toggle::make('is_active')
                        ->default(true),

                    Toggle::make('is_featured_on_home')
                        ->label('Featured on Home'),

                    TextInput::make('sort_order')
                        ->numeric()
                        ->default(0),

                    SpatieMediaLibraryFileUpload::make('avatar')
                        ->collection('avatar')
                        ->image()
                        ->avatar()
                        ->columnSpanFull(),
                ])
                ->columns(3),
        ]);
    }
}

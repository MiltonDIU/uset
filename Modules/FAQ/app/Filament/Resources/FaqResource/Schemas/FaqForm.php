<?php

namespace Modules\FAQ\app\Filament\Resources\FaqResource\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Modules\Academic\app\Models\Faculty;
use Modules\Academic\app\Models\Department;
use Modules\Academic\app\Models\Program;

class FaqForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('FAQ Content')
                ->schema([
                    TextInput::make('question')
                        ->required()
                        ->maxLength(255),

                    RichEditor::make('answer')
                        ->required()
                        ->columnSpanFull(),
                ]),

            Section::make('Classification')
                ->schema([
                    Select::make('faq_category_id')
                        ->relationship('category', 'name')
                        ->searchable()
                        ->preload()
                        ->createOptionForm([
                            TextInput::make('name')
                                ->required()
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn ($state, $set) => $set('slug', \Illuminate\Support\Str::slug($state))),
                            TextInput::make('slug')
                                ->required()
                                ->unique('faq_categories', 'slug'),
                        ]),

                    Select::make('faqable_type')
                        ->label('Linked To Type')
                        ->options([
                            Faculty::class => 'Faculty',
                            Department::class => 'Department',
                            Program::class => 'Program',
                        ])
                        ->live(),

                    Select::make('faqable_id')
                        ->label('Linked Target')
                        ->options(function ($get) {
                            $type = $get('faqable_type');
                            if (!$type) return [];
                            return $type::all()->pluck('name', 'id');
                        })
                        ->searchable()
                        ->preload()
                        ->hidden(fn ($get) => !$get('faqable_type')),
                ])
                ->columns(3),

            Section::make('Settings')
                ->schema([
                    Toggle::make('is_active')
                        ->default(true),

                    TextInput::make('sort_order')
                        ->numeric()
                        ->default(0),
                ])
                ->columns(2),
        ]);
    }
}

<?php

namespace Modules\News\app\Filament\Resources\NewsResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class NewsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('News Content')
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

                    Textarea::make('short_description')
                        ->rows(3)
                        ->columnSpanFull(),

                    RichEditor::make('content')
                        ->required()
                        ->columnSpanFull(),
                ])
                ->columnSpan(2),

            Section::make('Settings & Metadata')
                ->schema([
                    Select::make('news_category_id')
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

                    DatePicker::make('news_date')
                        ->default(now()),

                    DateTimePicker::make('publish_date'),

                    Select::make('status')
                        ->options([
                            'draft' => 'Draft',
                            'pending' => 'Pending Approval',
                            'published' => 'Published',
                        ])
                        ->default('draft')
                        ->required(),

                    Toggle::make('is_featured')
                        ->label('Featured News'),

                    Toggle::make('is_pinned')
                        ->label('Pinned News'),

                    Toggle::make('is_breaking')
                        ->label('Breaking News'),
                ])
                ->columnSpan(1),

            Section::make('Media')
                ->schema([
                    SpatieMediaLibraryFileUpload::make('featured_image')
                        ->collection('featured_image')
                        ->image()
                        ->imageEditor(),

                    SpatieMediaLibraryFileUpload::make('gallery')
                        ->collection('gallery')
                        ->multiple()
                        ->reorderable()
                        ->image()
                        ->imageEditor()
                        ->imagePreviewHeight('150'),
                ])
                ->columnSpanFull(),
        ])->columns(3);
    }
}

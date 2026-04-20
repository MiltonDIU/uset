<?php

namespace Modules\CMS\app\Filament\Resources\PageResource\Schemas;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(12) // পুরো লেআউটের জন্য 12 কলাম সিস্টেম
            ->components([
                // Left Side - Content Builder (Full width হবে এখন)
                Group::make([
                    Section::make('Content Builder')
                        ->schema([
                            Builder::make('content')
                                ->blocks([
                                    self::getHeroBlock(),
                                    self::getWhyChooseBlock(),
                                    self::getFeaturedProgramsBlock(),
                                    self::getStatsBlock(),
                                    self::getNewsEventsBlock(),
                                    self::getCTABlock(),
                                ])
                                ->collapsible()
                                ->cloneable()
                                ->columnSpanFull(), // FULL WIDTH করার জন্য
                        ]),
                ])->columnSpan(9), // 12 এর মধ্যে 9 অংশ নেবে

                // Right Side - Page Information & SEO
                Group::make([
                    Section::make('Page Information')
                        ->schema([
                            TextInput::make('title')
                                ->required()
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn($state, callable $set) => $set('slug', Str::slug($state))),
                            TextInput::make('slug')
                                ->required()
                                ->unique('pages', 'slug', ignoreRecord: true),
                            Toggle::make('is_published')
                                ->default(true),
                        ]),
                    Section::make('SEO')
                        ->schema([
                            TextInput::make('meta_title'),
                            Textarea::make('meta_description'),
                        ])->collapsed(),
                ])->columnSpan(3), // 12 এর মধ্যে 3 অংশ নেবে
            ]);
    }

    protected static function getHeroBlock(): Block
    {
        return Block::make('hero_slider')
            ->label('Hero Slider')
            ->icon('heroicon-o-presentation-chart-bar')
            ->schema([
                Repeater::make('slides')
                    ->schema([
                        FileUpload::make('image')
                            ->image()
                            ->directory('hero')
                            ->required()
                            ->columnSpanFull(),
                        TextInput::make('heading')
                            ->required()
                            ->columnSpanFull(),
                        Textarea::make('subheading')
                            ->columnSpanFull(),
                        Grid::make(2)
                            ->schema([
                                TextInput::make('primary_button_text'),
                                TextInput::make('primary_button_url'),
                                TextInput::make('secondary_button_text'),
                                TextInput::make('secondary_button_url'),
                            ])->columnSpanFull(),
                    ])
                    ->collapsible()
                    ->itemLabel(fn(array $state): ?string => $state['heading'] ?? null),
            ]);
    }

    protected static function getWhyChooseBlock(): Block
    {
        return Block::make('why_choose')
            ->label('Why Choose Section')
            ->icon('heroicon-o-question-mark-circle')
            ->schema([
                Grid::make(12) // 12 কলাম গ্রিড সিস্টেম
                ->schema([
                    TextInput::make('badge')
                        ->default('Why USET?')
                        ->columnSpan(3),
                    TextInput::make('title')
                        ->required()
                        ->columnSpan(9),
                ]),
                Textarea::make('description')
                    ->columnSpanFull(),
                Repeater::make('items')
                    ->schema([
                        TextInput::make('title')->required(),
                        Textarea::make('description')->required(),
                        Select::make('icon')
                            ->options([
                                'academic-cap' => 'Academic Cap',
                                'map' => 'Map',
                                'briefcase' => 'Briefcase',
                                'flag' => 'Flag',
                                'globe-alt' => 'Globe',
                            ])->default('academic-cap'),
                    ])
                    ->grid(3)
                    ->collapsible()
                    ->columnSpanFull(),
                Grid::make(2)
                    ->schema([
                        TextInput::make('button_text'),
                        TextInput::make('button_url'),
                    ])->columnSpanFull(),
            ]);
    }

    protected static function getFeaturedProgramsBlock(): Block
    {
        return Block::make('featured_programs')
            ->label('Featured Programs')
            ->icon('heroicon-o-academic-cap')
            ->schema([
                Grid::make(12)
                    ->schema([
                        TextInput::make('badge')
                            ->default('Our Programs')
                            ->columnSpan(3),
                        TextInput::make('title')
                            ->required()
                            ->columnSpan(9),
                    ]),
                Textarea::make('description')
                    ->columnSpanFull(),
                Grid::make(2)
                    ->schema([
                        TextInput::make('button_text')->default('Explore All Programs'),
                        TextInput::make('button_url')->default('#'),
                    ])->columnSpanFull(),
            ]);
    }

    protected static function getStatsBlock(): Block
    {
        return Block::make('statistics')
            ->label('Statistics Section')
            ->icon('heroicon-o-chart-bar')
            ->schema([
                Grid::make(12)
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->columnSpan(6),
                        TextInput::make('subtitle')
                            ->columnSpan(6),
                    ]),
                Repeater::make('items')
                    ->schema([
                        TextInput::make('label')->required(),
                        TextInput::make('value')->required(),
                    ])
                    ->grid(4)
                    ->maxItems(4)
                    ->columnSpanFull(),
            ]);
    }

    protected static function getNewsEventsBlock(): Block
    {
        return Block::make('news_events')
            ->label('News & Events')
            ->icon('heroicon-o-newspaper')
            ->schema([
                Grid::make(12)
                    ->schema([
                        TextInput::make('badge')
                            ->default('Stay Updated')
                            ->columnSpan(3),
                        TextInput::make('title')
                            ->required()
                            ->columnSpan(9),
                    ]),
                Textarea::make('description')
                    ->columnSpanFull(),
            ]);
    }

    protected static function getCTABlock(): Block
    {
        return Block::make('cta')
            ->label('Call to Action')
            ->icon('heroicon-o-megaphone')
            ->schema([
                Grid::make(12)
                    ->schema([
                        TextInput::make('badge')
                            ->default('Join USET')
                            ->columnSpan(3),
                        TextInput::make('title')
                            ->required()
                            ->columnSpan(9),
                    ]),
                Textarea::make('description')
                    ->columnSpanFull(),
                Grid::make(2)
                    ->schema([
                        TextInput::make('primary_button_text'),
                        TextInput::make('primary_button_url'),
                        TextInput::make('secondary_button_text'),
                        TextInput::make('secondary_button_url'),
                    ])->columnSpanFull(),
            ]);
    }
}

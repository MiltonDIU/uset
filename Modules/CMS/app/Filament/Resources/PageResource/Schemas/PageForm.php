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
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Tabs::make('Page Content Builder')
                    ->tabs([
                        Tab::make('Designer')
                            ->icon('heroicon-o-cursor-arrow-rays')
                            ->schema([
                                Section::make('Designer Workspace')
                                    ->description('Build your page layout here. Use Sections and Columns to structure your content.')
                                    ->schema([
                                        Builder::make('content')
                                            ->label('Sections')
                                            ->blocks([
                                                self::getSectionBlock(),
                                            ])
                                            ->collapsible()
                                            ->cloneable()
                                            ->columnSpanFull()
                                            ->addActionLabel('Add New Section'),
                                    ]),
                            ]),
                        Tab::make('Settings & SEO')
                            ->icon('heroicon-o-cog-6-tooth')
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        Section::make('Page Information')
                                            ->schema([
                                                TextInput::make('title')
                                                    ->required()
                                                    ->live(onBlur: true)
                                                    ->afterStateUpdated(fn($state, callable $set) => $set('slug', Str::slug($state))),
                                                TextInput::make('slug')
                                                    ->required()
                                                    ->unique('pages', 'slug', ignoreRecord: true),
                                                Select::make('template')
                                                    ->options([
                                                        'home' => 'Home Template',
                                                        'default' => 'Default (Full Width)',
                                                        'with_sidebar' => 'Page with Sidebar',
                                                        'contact' => 'Contact Page',
                                                    ])
                                                    ->default('default')
                                                    ->required(),
                                                Toggle::make('is_published')
                                                    ->default(true),
                                            ])->columnSpan(1),
                                        Section::make('SEO Settings')
                                            ->schema([
                                                TextInput::make('meta_title'),
                                                Textarea::make('meta_description')
                                                    ->rows(5),
                                            ])->columnSpan(1),
                                    ]),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    protected static function getSectionBlock(): Block
    {
        return Block::make('layout_section')
            ->label('Section')
            ->icon('heroicon-o-squares-plus')
            ->schema([
                Grid::make(3)
                    ->schema([
                        Select::make('background_color')
                            ->options([
                                'bg-white' => 'White',
                                'bg-light' => 'Light Gray',
                                'bg-success-light' => 'Success Light',
                                'bg-primary-700' => 'Dark Blue',
                            ])->default('bg-white'),
                        TextInput::make('padding_y')
                            ->label('Vertical Padding')
                            ->default('py-5'),
                        Toggle::make('is_full_width')
                            ->label('Full Width Page?')
                            ->default(false),
                    ]),
                
                Grid::make(1)
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Select::make('layout')
                                    ->label('Quick Layout')
                                    ->options([
                                        '12' => '1 Column (100%)',
                                        '6,6' => '2 Columns (50% | 50%)',
                                        '4,4,4' => '3 Columns (33% | 33% | 33%)',
                                        '3,3,3,3' => '4 Columns (25% | 25% | 25% | 25%)',
                                        '8,4' => '2 Columns (75% | 25%)',
                                        '4,8' => '2 Columns (25% | 75%)',
                                    ])
                                    ->live()
                                    ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                        if (! $state) return;
                                        $widths = explode(',', $state);
                                        $currentColumns = $get('columns') ?? [];
                                        $newColumns = [];
                                        $i = 0;
                                        // Preserve existing keys (UUIDs) for items to keep their state
                                        foreach ($currentColumns as $key => $column) {
                                            if (isset($widths[$i])) {
                                                $newColumns[$key] = $column;
                                                $newColumns[$key]['width'] = "col-md-{$widths[$i]}";
                                                $i++;
                                            }
                                        }
                                        // Add new columns if needed
                                        while ($i < count($widths)) {
                                            $newColumns[] = [
                                                'width' => "col-md-{$widths[$i]}",
                                                'content' => []
                                            ];
                                            $i++;
                                        }
                                        $set('columns', $newColumns);
                                        $set('column_count', count($widths));
                                    }),
                                TextInput::make('column_count')
                                    ->label('Total Columns')
                                    ->numeric()
                                    ->live()
                                    ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                        if (! $state || ! is_numeric($state)) return;
                                        $count = (int) $state;
                                        if ($count <= 0 || $count > 12) return;
                                        
                                        $widthPerCol = floor(12 / $count);
                                        if ($widthPerCol < 1) $widthPerCol = 1;

                                        $currentColumns = $get('columns') ?? [];
                                        $newColumns = [];
                                        $i = 0;
                                        foreach ($currentColumns as $key => $column) {
                                            if ($i < $count) {
                                                $newColumns[$key] = $column;
                                                $newColumns[$key]['width'] = "col-md-{$widthPerCol}";
                                                $i++;
                                            }
                                        }
                                        while ($i < $count) {
                                            $newColumns[] = [
                                                'width' => "col-md-{$widthPerCol}",
                                                'content' => [],
                                            ];
                                            $i++;
                                        }
                                        $set('columns', $newColumns);
                                        $set('layout', null);
                                    }),
                            ]),
                    ]),

                Repeater::make('columns')
                    ->label('Columns')
                    ->schema([
                        Builder::make('content')
                            ->label('Column Content')
                            ->blocks([
                                self::getRichTextBlock(),
                                self::getImageBlock(),
                                self::getHeroBlock(),
                                self::getWhyChooseBlock(),
                                self::getFeaturedProgramsBlock(),
                                self::getStatsBlock(),
                                self::getNewsEventsBlock(),
                                self::getCTABlock(),
                            ])
                            ->collapsible()
                            ->cloneable()
                            ->addActionLabel('Add Block'),
                    ])
                    ->grid(fn($get) => min(4, (int) ($get('column_count') ?: 1)))
                    ->collapsible()
                    ->itemLabel(fn(array $state): ?string => $state['width'] ?? 'Column')
                    ->addActionLabel('Add New Column'),
            ]);
    }

    protected static function getRichTextBlock(): Block
    {
        return Block::make('rich_text')
            ->label('Rich Text Content')
            ->icon('heroicon-o-document-text')
            ->schema([
                Textarea::make('content')
                    ->label('HTML/Text Content')
                    ->rows(10)
                    ->required(),
            ]);
    }

    protected static function getImageBlock(): Block
    {
        return Block::make('single_image')
            ->label('Single Image')
            ->icon('heroicon-o-camera')
            ->schema([
                FileUpload::make('image')
                    ->image()
                    ->directory('pages')
                    ->required(),
                TextInput::make('caption'),
                Select::make('alignment')
                    ->options([
                        'text-left' => 'Left',
                        'text-center' => 'Center',
                        'text-right' => 'Right',
                    ])->default('text-center'),
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
                    ->itemLabel(fn (array $state): ?string => $state['heading'] ?? null),
            ]);
    }

    protected static function getWhyChooseBlock(): Block
    {
        return Block::make('why_choose')
            ->label('Why Choose Section')
            ->icon('heroicon-o-question-mark-circle')
            ->schema([
                Grid::make(12)
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

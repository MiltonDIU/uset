<?php

namespace Modules\Social\app\Filament\Resources\SocialLinkResource\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Modules\Social\app\Models\SocialLink;

class SocialLinkForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Link Details')
                ->schema([
                    Select::make('platform')
                        ->options([
                            'facebook' => 'Facebook',
                            'twitter' => 'Twitter',
                            'instagram' => 'Instagram',
                            'linkedin' => 'LinkedIn',
                            'youtube' => 'YouTube',
                            'whatsapp' => 'WhatsApp',
                            'github' => 'GitHub',
                            'website' => 'Other Website',
                        ])
                        ->required()
                        ->live(),

                    TextInput::make('url')
                        ->label('URL')
                        ->url()
                        ->required()
                        ->maxLength(255),

                    TextInput::make('icon')
                        ->label('Custom Icon Class')
                        ->placeholder('e.g. fab fa-facebook-f')
                        ->helperText('Leave empty to use default platform icon.'),
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

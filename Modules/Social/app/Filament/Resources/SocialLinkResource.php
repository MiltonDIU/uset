<?php

namespace Modules\Social\app\Filament\Resources;

use Modules\Social\app\Filament\Resources\SocialLinkResource\Pages;
use Modules\Social\app\Filament\Resources\SocialLinkResource\Schemas\SocialLinkForm;
use Modules\Social\app\Filament\Resources\SocialLinkResource\Tables\SocialLinkTable;
use Modules\Social\app\Models\SocialLink;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class SocialLinkResource extends Resource
{
    protected static ?string $model = SocialLink::class;

    protected static \UnitEnum|string|null $navigationGroup = 'Settings';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-share';

    protected static ?int $navigationSort = 10;

    public static function form(Schema $schema): Schema
    {
        return SocialLinkForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SocialLinkTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSocialLinks::route('/'),
            'create' => Pages\CreateSocialLink::route('/create'),
            'edit' => Pages\EditSocialLink::route('/{record}/edit'),
        ];
    }
}

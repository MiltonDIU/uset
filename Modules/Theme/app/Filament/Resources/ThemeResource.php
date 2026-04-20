<?php

namespace Modules\Theme\app\Filament\Resources;

use Modules\Theme\app\Filament\Resources\ThemeResource\Pages\CreateTheme;
use Modules\Theme\app\Filament\Resources\ThemeResource\Pages\EditTheme;
use Modules\Theme\app\Filament\Resources\ThemeResource\Pages\ListThemes;
use Modules\Theme\app\Filament\Resources\ThemeResource\Schemas\ThemeForm;
use Modules\Theme\app\Filament\Resources\ThemeResource\Tables\ThemesTable;
use Modules\Theme\app\Models\Theme;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ThemeResource extends Resource
{
    protected static ?string $model = Theme::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return ThemeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ThemesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListThemes::route('/'),
            'create' => CreateTheme::route('/create'),
            'edit' => EditTheme::route('/{record}/edit'),
        ];
    }
}

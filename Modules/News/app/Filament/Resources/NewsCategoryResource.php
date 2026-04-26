<?php

namespace Modules\News\app\Filament\Resources;

use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Modules\News\app\Filament\Resources\NewsCategoryResource\Pages;
use Modules\News\app\Filament\Resources\NewsCategoryResource\Schemas\NewsCategoryForm;
use Modules\News\app\Filament\Resources\NewsCategoryResource\Tables\NewsCategoryTable;
use Modules\News\app\Models\NewsCategory;

class NewsCategoryResource extends Resource
{
    protected static ?string $model = NewsCategory::class;

    protected static \UnitEnum|string|null $navigationGroup = 'News & Events';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-tag';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return NewsCategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return NewsCategoryTable::schema($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNewsCategories::route('/'),
            'create' => Pages\CreateNewsCategory::route('/create'),
            'edit' => Pages\EditNewsCategory::route('/{record}/edit'),
        ];
    }
}

<?php

namespace Modules\News\app\Filament\Resources;

use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Modules\News\app\Filament\Resources\NewsResource\Pages;
use Modules\News\app\Filament\Resources\NewsResource\Schemas\NewsForm;
use Modules\News\app\Filament\Resources\NewsResource\Tables\NewsTable;
use Modules\News\app\Models\News;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;

    protected static \UnitEnum|string|null $navigationGroup = 'News & Events';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-newspaper';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return NewsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return NewsTable::schema($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'edit' => Pages\EditNews::route('/{record}/edit'),
        ];
    }
}

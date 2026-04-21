<?php

namespace Modules\CMS\app\Filament\Resources\PageResource;

use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Modules\CMS\app\Filament\Resources\PageResource\Schemas\PageForm;
use Modules\CMS\app\Filament\Resources\PageResource\Tables\PageTable;
use Modules\CMS\app\Models\Page;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static \UnitEnum|string|null $navigationGroup = 'CMS';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-document-duplicate';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return PageForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PageTable::schema($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}

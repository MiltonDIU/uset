<?php

namespace Modules\CMS\app\Filament\Resources\Page;

use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Modules\CMS\app\Filament\Resources\Page\Infolists\PageInfolist;
use Modules\CMS\app\Filament\Resources\Page\Schemas\PageForm;
use Modules\CMS\app\Filament\Resources\Page\Tables\PageTable;
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

    public static function infolist(Schema $schema): Schema
    {
        return PageInfolist::schema($schema);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'view' => Pages\ViewPage::route('/{record}'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}

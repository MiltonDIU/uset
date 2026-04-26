<?php

namespace Modules\Events\app\Filament\Resources;

use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Modules\Events\app\Filament\Resources\EventCategoryResource\Pages;
use Modules\Events\app\Filament\Resources\EventCategoryResource\Schemas\EventCategoryForm;
use Modules\Events\app\Filament\Resources\EventCategoryResource\Tables\EventCategoryTable;
use Modules\Events\app\Models\EventCategory;

class EventCategoryResource extends Resource
{
    protected static ?string $model = EventCategory::class;

    protected static \UnitEnum|string|null $navigationGroup = 'News & Events';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-bookmark';

    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return EventCategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EventCategoryTable::schema($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEventCategories::route('/'),
            'create' => Pages\CreateEventCategory::route('/create'),
            'edit' => Pages\EditEventCategory::route('/{record}/edit'),
        ];
    }
}

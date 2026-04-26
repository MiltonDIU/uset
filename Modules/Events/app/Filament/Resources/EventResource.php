<?php

namespace Modules\Events\app\Filament\Resources;

use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Modules\Events\app\Filament\Resources\EventResource\Pages;
use Modules\Events\app\Filament\Resources\EventResource\Schemas\EventForm;
use Modules\Events\app\Filament\Resources\EventResource\Tables\EventTable;
use Modules\Events\app\Models\Event;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static \UnitEnum|string|null $navigationGroup = 'News & Events';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return EventForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EventTable::schema($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}

<?php

namespace Modules\Academic\app\Filament\Resources\AcademicEvent;

use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Modules\Academic\app\Filament\Resources\AcademicEvent\Schemas\AcademicEventForm;
use Modules\Academic\app\Filament\Resources\AcademicEvent\Tables\AcademicEventTable;
use Modules\Academic\app\Models\AcademicEvent;

class AcademicEventResource extends Resource
{
    protected static ?string $model = AcademicEvent::class;

    protected static \UnitEnum|string|null $navigationGroup = 'Academic';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-calendar';

    protected static ?string $navigationLabel = 'Academic Calendar';

    protected static ?int $navigationSort = 8;

    public static function form(Schema $schema): Schema
    {
        return AcademicEventForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AcademicEventTable::schema($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAcademicEvents::route('/'),
            'create' => Pages\CreateAcademicEvent::route('/create'),
            'edit' => Pages\EditAcademicEvent::route('/{record}/edit'),
        ];
    }
}

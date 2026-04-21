<?php

namespace Modules\Academic\app\Filament\Resources\TuitionTypeResource;

use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Modules\Academic\app\Filament\Resources\TuitionTypeResource\Schemas\TuitionTypeForm;
use Modules\Academic\app\Filament\Resources\TuitionTypeResource\Tables\TuitionTypeTable;
use Modules\Academic\Models\TuitionType;

class TuitionTypeResource extends Resource
{
    protected static ?string $model = TuitionType::class;

    protected static \UnitEnum|string|null $navigationGroup = 'Academic';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-currency-dollar';

    protected static ?int $navigationSort = 5;

    public static function form(Schema $schema): Schema
    {
        return TuitionTypeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TuitionTypeTable::schema($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTuitionTypes::route('/'),
            'create' => Pages\CreateTuitionType::route('/create'),
            'edit' => Pages\EditTuitionType::route('/{record}/edit'),
        ];
    }
}

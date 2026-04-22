<?php

namespace Modules\Academic\app\Filament\Resources\ProgramType;

use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Modules\Academic\app\Filament\Resources\ProgramType\Schemas\ProgramTypeForm;
use Modules\Academic\app\Filament\Resources\ProgramType\Tables\ProgramTypeTable;
use Modules\Academic\app\Models\ProgramType;

class ProgramTypeResource extends Resource
{
    protected static ?string $model = ProgramType::class;

    protected static \UnitEnum|string|null $navigationGroup = 'Academic';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-list-bullet';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return ProgramTypeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProgramTypeTable::schema($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProgramTypes::route('/'),
            'create' => Pages\CreateProgramType::route('/create'),
            'edit' => Pages\EditProgramType::route('/{record}/edit'),
        ];
    }
}

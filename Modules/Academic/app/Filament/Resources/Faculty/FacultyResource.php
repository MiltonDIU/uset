<?php

namespace Modules\Academic\app\Filament\Resources\Faculty;

use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Modules\Academic\app\Filament\Resources\Faculty\Schemas\FacultyForm;
use Modules\Academic\app\Filament\Resources\Faculty\Tables\FacultyTable;
use Modules\Academic\app\Models\Faculty;

class FacultyResource extends Resource
{
    protected static ?string $model = Faculty::class;

    protected static \UnitEnum|string|null $navigationGroup = 'Academic';

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return FacultyForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FacultyTable::schema($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFaculties::route('/'),
            'create' => Pages\CreateFaculty::route('/create'),
            'edit' => Pages\EditFaculty::route('/{record}/edit'),
        ];
    }
}

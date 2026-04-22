<?php

namespace Modules\Academic\app\Filament\Resources\Program;

use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Modules\Academic\app\Filament\Resources\Program\Infolists\ProgramInfolist;
use Modules\Academic\app\Filament\Resources\Program\Schemas\ProgramForm;
use Modules\Academic\app\Filament\Resources\Program\Tables\ProgramTable;
use Modules\Academic\app\Models\Program;

class ProgramResource extends Resource
{
    protected static ?string $model = Program::class;

    protected static \UnitEnum|string|null $navigationGroup = 'Academic';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return ProgramForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProgramTable::schema($table);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ProgramInfolist::schema($schema);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPrograms::route('/'),
            'create' => Pages\CreateProgram::route('/create'),
            'view' => Pages\ViewProgram::route('/{record}'),
            'edit' => Pages\EditProgram::route('/{record}/edit'),
        ];
    }
}

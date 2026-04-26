<?php

namespace Modules\Academic\app\Filament\Resources\AcademicSession;

use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Modules\Academic\app\Filament\Resources\AcademicSession\Schemas\AcademicSessionForm;
use Modules\Academic\app\Filament\Resources\AcademicSession\Tables\AcademicSessionTable;
use Modules\Academic\app\Models\AcademicSession;

class AcademicSessionResource extends Resource
{
    protected static ?string $model = AcademicSession::class;

    protected static \UnitEnum|string|null $navigationGroup = 'Academic';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?int $navigationSort = 7;

    public static function form(Schema $schema): Schema
    {
        return AcademicSessionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AcademicSessionTable::schema($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAcademicSessions::route('/'),
            'create' => Pages\CreateAcademicSession::route('/create'),
            'edit' => Pages\EditAcademicSession::route('/{record}/edit'),
        ];
    }
}

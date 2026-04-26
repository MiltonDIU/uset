<?php

namespace Modules\Academic\app\Filament\Resources\FacultyMember;

use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Modules\Academic\app\Filament\Resources\FacultyMember\Schemas\FacultyMemberForm;
use Modules\Academic\app\Filament\Resources\FacultyMember\Tables\FacultyMemberTable;
use Modules\Academic\app\Models\FacultyMember;

class FacultyMemberResource extends Resource
{
    protected static ?string $model = FacultyMember::class;

    protected static \UnitEnum|string|null $navigationGroup = 'Academic';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-users';

    protected static ?int $navigationSort = 5;

    public static function form(Schema $schema): Schema
    {
        return FacultyMemberForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FacultyMemberTable::schema($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFacultyMembers::route('/'),
            'create' => Pages\CreateFacultyMember::route('/create'),
            'edit' => Pages\EditFacultyMember::route('/{record}/edit'),
        ];
    }
}

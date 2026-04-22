<?php

namespace Modules\Academic\app\Filament\Resources\Department;

use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Modules\Academic\app\Filament\Resources\Department\Infolists\DepartmentInfolist;
use Modules\Academic\app\Filament\Resources\Department\Schemas\DepartmentForm;
use Modules\Academic\app\Filament\Resources\Department\Tables\DepartmentTable;
use Modules\Academic\app\Models\Department;

class DepartmentResource extends Resource
{
    protected static ?string $model = Department::class;

    protected static \UnitEnum|string|null $navigationGroup = 'Academic';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return DepartmentForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DepartmentTable::schema($table);
    }

    public static function infolist(Schema $schema): Schema
    {
        return DepartmentInfolist::schema($schema);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDepartments::route('/'),
            'create' => Pages\CreateDepartment::route('/create'),
            'edit' => Pages\EditDepartment::route('/{record}/edit'),
        ];
    }
}

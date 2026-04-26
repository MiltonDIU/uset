<?php

namespace Modules\Academic\app\Filament\Resources\Committee;

use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Modules\Academic\app\Filament\Resources\Committee\Schemas\CommitteeForm;
use Modules\Academic\app\Filament\Resources\Committee\Tables\CommitteeTable;
use Modules\Academic\app\Filament\Resources\Committee\Infolists\CommitteeInfolist;
use Modules\Academic\app\Filament\Resources\Committee\RelationManagers\MembersRelationManager;
use Modules\Academic\app\Models\Committee;

class CommitteeResource extends Resource
{
    protected static ?string $model = Committee::class;

    protected static \UnitEnum|string|null $navigationGroup = 'Academic';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-users';

    protected static ?int $navigationSort = 9;

    public static function form(Schema $schema): Schema
    {
        return CommitteeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CommitteeInfolist::schema($schema);
    }

    public static function table(Table $table): Table
    {
        return CommitteeTable::schema($table);
    }

    public static function getRelations(): array
    {
        return [
            MembersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCommittees::route('/'),
            'create' => Pages\CreateCommittee::route('/create'),
            'view' => Pages\ViewCommittee::route('/{record}'),
            'edit' => Pages\EditCommittee::route('/{record}/edit'),
        ];
    }
}

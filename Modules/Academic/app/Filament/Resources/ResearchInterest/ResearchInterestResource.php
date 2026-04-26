<?php

namespace Modules\Academic\app\Filament\Resources\ResearchInterest;

use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Modules\Academic\app\Filament\Resources\ResearchInterest\Schemas\ResearchInterestForm;
use Modules\Academic\app\Filament\Resources\ResearchInterest\Tables\ResearchInterestTable;
use Modules\Academic\app\Models\ResearchInterest;

class ResearchInterestResource extends Resource
{
    protected static ?string $model = ResearchInterest::class;

    protected static \UnitEnum|string|null $navigationGroup = 'Academic';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-light-bulb';

    protected static ?int $navigationSort = 6;

    public static function form(Schema $schema): Schema
    {
        return ResearchInterestForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ResearchInterestTable::schema($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListResearchInterests::route('/'),
            'create' => Pages\CreateResearchInterest::route('/create'),
            'edit' => Pages\EditResearchInterest::route('/{record}/edit'),
        ];
    }
}

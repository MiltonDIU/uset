<?php

namespace Modules\Labs\app\Filament\Resources;

use Modules\Labs\app\Filament\Resources\LabResource\Pages;
use Modules\Labs\app\Filament\Resources\LabResource\Schemas\LabForm;
use Modules\Labs\app\Filament\Resources\LabResource\Tables\LabTable;
use Modules\Labs\app\Models\Lab;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class LabResource extends Resource
{
    protected static ?string $model = Lab::class;

    protected static \UnitEnum|string|null $navigationGroup = 'University Management';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-beaker';

    protected static ?int $navigationSort = 11;

    public static function form(Schema $schema): Schema
    {
        return LabForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LabTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLabs::route('/'),
            'create' => Pages\CreateLab::route('/create'),
            'edit' => Pages\EditLab::route('/{record}/edit'),
        ];
    }
}

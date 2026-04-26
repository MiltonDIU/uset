<?php

namespace Modules\FAQ\app\Filament\Resources;

use Modules\FAQ\app\Filament\Resources\FaqResource\Pages;
use Modules\FAQ\app\Filament\Resources\FaqResource\Schemas\FaqForm;
use Modules\FAQ\app\Filament\Resources\FaqResource\Tables\FaqTable;
use Modules\FAQ\app\Models\Faq;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class FaqResource extends Resource
{
    protected static ?string $model = Faq::class;

    protected static \UnitEnum|string|null $navigationGroup = 'CMS';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-question-mark-circle';

    protected static ?int $navigationSort = 5;

    public static function form(Schema $schema): Schema
    {
        return FaqForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FaqTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFaqs::route('/'),
            'create' => Pages\CreateFaq::route('/create'),
            'edit' => Pages\EditFaq::route('/{record}/edit'),
        ];
    }
}

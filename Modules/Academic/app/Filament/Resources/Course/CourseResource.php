<?php

namespace Modules\Academic\app\Filament\Resources\Course;

use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Modules\Academic\app\Filament\Resources\Course\Schemas\CourseForm;
use Modules\Academic\app\Filament\Resources\Course\Tables\CourseTable;
use Modules\Academic\app\Models\Course;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static \UnitEnum|string|null $navigationGroup = 'Academic';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-book-open';

    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return CourseForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CourseTable::schema($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourse::route('/create'),
            'edit' => Pages\EditCourse::route('/{record}/edit'),
        ];
    }
}

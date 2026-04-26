<?php

namespace Modules\Testimonials\app\Filament\Resources;

use Modules\Testimonials\app\Filament\Resources\TestimonialResource\Pages;
use Modules\Testimonials\app\Filament\Resources\TestimonialResource\Schemas\TestimonialForm;
use Modules\Testimonials\app\Filament\Resources\TestimonialResource\Tables\TestimonialTable;
use Modules\Testimonials\app\Models\Testimonial;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;

    protected static \UnitEnum|string|null $navigationGroup = 'University Management';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';

    protected static ?int $navigationSort = 10;

    public static function form(Schema $schema): Schema
    {
        return TestimonialForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TestimonialTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }
}

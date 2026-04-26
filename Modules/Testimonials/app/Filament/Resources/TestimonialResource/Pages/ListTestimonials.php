<?php

namespace Modules\Testimonials\app\Filament\Resources\TestimonialResource\Pages;

use Modules\Testimonials\app\Filament\Resources\TestimonialResource;
use Filament\Resources\Pages\ListRecords;

class ListTestimonials extends ListRecords
{
    protected static string $resource = TestimonialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}

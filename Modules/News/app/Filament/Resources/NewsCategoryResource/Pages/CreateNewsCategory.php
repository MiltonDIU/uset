<?php

namespace Modules\News\app\Filament\Resources\NewsCategoryResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\News\app\Filament\Resources\NewsCategoryResource;

class CreateNewsCategory extends CreateRecord
{
    protected static string $resource = NewsCategoryResource::class;
}

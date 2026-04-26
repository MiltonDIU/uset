<?php

namespace Modules\Academic\app\Filament\Resources\Course\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Academic\app\Filament\Resources\Course\CourseResource;

class CreateCourse extends CreateRecord
{
    protected static string $resource = CourseResource::class;
}

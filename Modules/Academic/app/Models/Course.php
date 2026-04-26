<?php

namespace Modules\Academic\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Academic\app\Enums\ActiveStatus;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'program_id',
        'name',
        'code',
        'slug',
        'credits',
        'type',
        'semester_level',
        'description',
        'sort_order',
        'is_active',
    ];

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    public function prerequisites(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'course_prerequisite', 'course_id', 'prerequisite_id');
    }

    public function requiredFor(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'course_prerequisite', 'prerequisite_id', 'course_id');
    }

    protected function casts(): array
    {
        return [
            'is_active' => ActiveStatus::class,
        ];
    }
}

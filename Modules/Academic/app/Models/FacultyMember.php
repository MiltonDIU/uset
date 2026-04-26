<?php

namespace Modules\Academic\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Academic\app\Enums\ActiveStatus;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class FacultyMember extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes;

    protected $fillable = [
        'department_id',
        'name',
        'slug',
        'designation',
        'email',
        'phone',
        'bio',
        'sort_order',
        'is_active',
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function researchInterests(): BelongsToMany
    {
        return $this->belongsToMany(ResearchInterest::class, 'faculty_member_research_interest');
    }

    protected function casts(): array
    {
        return [
            'is_active' => ActiveStatus::class,
        ];
    }
}

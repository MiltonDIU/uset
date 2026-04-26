<?php

namespace Modules\Academic\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Academic\app\Enums\ActiveStatus;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Program extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'department_id',
        'program_type_id',
        'name',
        'sub_title',
        'slug',
        'overview',
        'description',
        'duration',
        'total_semester',
        'semester_duration',
        'total_credits',
        'sort_order',
        'is_active',
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function programType(): BelongsTo
    {
        return $this->belongsTo(ProgramType::class);
    }

    public function tuitions(): HasMany
    {
        return $this->hasMany(Tuition::class);
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class)->orderBy('sort_order');
    }

    public function year1Courses(): HasMany
    {
        return $this->hasMany(Course::class)->where('semester_level', 'Year 1')->orderBy('sort_order');
    }

    public function year2Courses(): HasMany
    {
        return $this->hasMany(Course::class)->where('semester_level', 'Year 2')->orderBy('sort_order');
    }

    public function year3Courses(): HasMany
    {
        return $this->hasMany(Course::class)->where('semester_level', 'Year 3')->orderBy('sort_order');
    }

    public function year4Courses(): HasMany
    {
        return $this->hasMany(Course::class)->where('semester_level', 'Year 4')->orderBy('sort_order');
    }

    public function facilities(): MorphMany
    {
        return $this->morphMany(Facility::class, 'facilityable');
    }

    public function careerProspects(): HasMany
    {
        return $this->hasMany(CareerProspect::class);
    }

    public function admissionRequirements(): HasMany
    {
        return $this->hasMany(AdmissionRequirement::class);
    }

    protected function casts(): array
    {
        return [
            'is_active' => ActiveStatus::class,
        ];
    }
}

<?php

namespace Modules\Academic\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ResearchInterest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_active',
    ];

    public function facultyMembers(): BelongsToMany
    {
        return $this->belongsToMany(FacultyMember::class, 'faculty_member_research_interest');
    }
}

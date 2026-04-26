<?php

namespace Modules\Academic\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Academic\app\Enums\ActiveStatus;

class CommitteeMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'committee_id',
        'faculty_member_id',
        'name',
        'designation',
        'sort_order',
        'is_active',
    ];

    public function committee(): BelongsTo
    {
        return $this->belongsTo(Committee::class);
    }

    public function facultyMember(): BelongsTo
    {
        return $this->belongsTo(FacultyMember::class);
    }

    protected function casts(): array
    {
        return [
            'is_active' => ActiveStatus::class,
        ];
    }
}

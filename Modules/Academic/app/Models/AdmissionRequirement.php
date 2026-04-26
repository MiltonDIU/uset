<?php

namespace Modules\Academic\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdmissionRequirement extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_id',
        'title',
        'description',
        'is_mandatory',
        'sort_order',
    ];

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    protected function casts(): array
    {
        return [
            'is_mandatory' => 'boolean',
        ];
    }
}

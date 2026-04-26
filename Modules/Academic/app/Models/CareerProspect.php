<?php

namespace Modules\Academic\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CareerProspect extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_id',
        'title',
        'description',
        'sort_order',
        'is_active',
    ];

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }
}

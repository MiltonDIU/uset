<?php

namespace Modules\Academic\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Academic\app\Enums\ActiveStatus;

class AcademicSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'start_date',
        'end_date',
        'is_active',
    ];

    public function events(): HasMany
    {
        return $this->hasMany(AcademicEvent::class);
    }

    protected function casts(): array
    {
        return [
            'is_active' => ActiveStatus::class,
            'start_date' => 'date',
            'end_date' => 'date',
        ];
    }
}

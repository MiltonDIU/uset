<?php

namespace Modules\Academic\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Facility extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'facilityable_id',
        'facilityable_type',
        'title',
        'description',
        'icon',
        'image',
        'sort_order',
        'is_active',
    ];

    public function facilityable(): MorphTo
    {
        return $this->morphTo();
    }
}

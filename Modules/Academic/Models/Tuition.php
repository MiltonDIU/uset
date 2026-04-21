<?php

namespace Modules\Academic\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tuition extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'program_id',
        'tuition_type_id',
        'min_credit',
        'max_credit',
        'min_total_cost',
        'max_total_cost',
        'min_tuition_fee',
        'max_tuition_fee',
        'admission_fee',
        'sort_order',
        'is_active',
    ];

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    public function tuitionType(): BelongsTo
    {
        return $this->belongsTo(TuitionType::class);
    }
}

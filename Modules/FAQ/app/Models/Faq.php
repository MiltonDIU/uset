<?php

namespace Modules\FAQ\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faq extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'faq_category_id',
        'faqable_id',
        'faqable_type',
        'question',
        'answer',
        'is_active',
        'sort_order',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(FaqCategory::class, 'faq_category_id');
    }

    public function faqable(): MorphTo
    {
        return $this->morphTo();
    }
}

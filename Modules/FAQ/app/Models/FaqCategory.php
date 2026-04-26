<?php

namespace Modules\FAQ\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FaqCategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'is_active',
        'sort_order',
    ];

    public function faqs(): HasMany
    {
        return $this->hasMany(Faq::class)->orderBy('sort_order');
    }
}

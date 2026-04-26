<?php

namespace Modules\Testimonials\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Testimonial extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'testimonialable_id',
        'testimonialable_type',
        'name',
        'designation',
        'quote',
        'is_active',
        'is_featured_on_home',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured_on_home' => 'boolean',
    ];

    public function testimonialable(): MorphTo
    {
        return $this->morphTo();
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')
            ->singleFile();
    }
}

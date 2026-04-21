<?php

namespace Modules\Theme\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Theme extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = ['name', 'slug', 'description', 'thumbnail', 'is_active', 'framework'];

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(300)
            ->height(200)
            ->sharpen(10);
    }

    public function getThumbnailAttribute(): ?string
    {
        return $this->getFirstMediaUrl('thumbnail', 'thumb') ?: ($this->attributes['thumbnail'] ?? null);
    }

    public static function active(): ?self
    {
        return static::where('is_active', true)->first();
    }

    public function activate(): void
    {
        static::query()->update(['is_active' => false]);
        $this->update(['is_active' => true]);
        
        $themeService = app(\Modules\Theme\app\Services\ThemeService::class);
        $themeService->refresh();
    }

    /**
     * Get the CSS grid class for a given span based on the theme's framework.
     * Automatically handles responsiveness (e.g., col-12 for mobile).
     */
    public function getGridClass(string|int $span): string
    {
        $span = trim($span);
        $framework = $this->framework ?? 'bootstrap4';

        return match ($framework) {
            'bootstrap4', 'bootstrap5' => "col-12 col-md-{$span}",
            'tailwind' => $span == '12' ? 'w-full' : "w-full md:w-{$span}/12",
            default => "col-12 col-md-{$span}",
        };
    }
}

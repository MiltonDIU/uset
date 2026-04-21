<?php

namespace Modules\Theme\app\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Modules\Theme\app\Models\Theme;

class ThemeService
{
    protected ?Theme $theme = null;

    public function current(): Theme
    {
        if (! $this->theme) {
            $slug = Cache::remember('active_theme_slug', 3600, function () {
                if (! Schema::hasTable('themes')) {
                    return 'default';
                }
                $theme = Theme::where('is_active', true)->first() ?? Theme::where('slug', 'default')->first();

                return $theme?->slug ?? 'default';
            });

            $this->theme = Theme::where('slug', $slug)->first();

            if (! $this->theme) {
                $this->theme = Theme::where('slug', 'default')->first() ?: new Theme(['name' => 'Default', 'slug' => 'default', 'is_active' => true]);
            }
        }

        return $this->theme;
    }

    public function refresh(): void
    {
        Cache::forget('active_theme_slug');
        $this->theme = null;
        $this->current();
    }

    public function slug(): string
    {
        return $this->current()->slug;
    }

    public function assetUrl(string $path): string
    {
        return asset("themes/{$this->slug()}/assets/{$path}");
    }

    public function view(string $view): string
    {
        return "themes.{$this->slug()}.{$view}";
    }
}

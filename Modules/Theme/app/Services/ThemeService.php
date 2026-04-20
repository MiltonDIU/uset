<?php

namespace Modules\Theme\app\Services;

use Modules\Theme\app\Models\Theme;
use Illuminate\Support\Facades\Cache;

class ThemeService
{
    protected ?Theme $theme = null;

    public function current(): Theme
    {
        if (! $this->theme) {
            $slug = Cache::rememberForever('active_theme_slug', function () {
                if (!\Illuminate\Support\Facades\Schema::hasTable('themes')) {
                    return 'default';
                }
                $theme = Theme::active() ?? Theme::where('slug', 'default')->first();

                return $theme?->slug ?? 'default';
            });

            $this->theme = Theme::where('slug', $slug)->first();

            if (! $this->theme) {
                // Fallback if the slug in cache doesn't exist anymore
                $this->theme = Theme::where('slug', 'default')->first();
            }

            if (! $this->theme) {
                // Hard fallback if nothing in DB
                $this->theme = new Theme(['name' => 'Default', 'slug' => 'default']);
            }
        }

        return $this->theme;
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

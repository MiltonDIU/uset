<?php

use Modules\Theme\app\Services\ThemeService;
use Illuminate\View\View;

if (! function_exists('theme_asset')) {
    function theme_asset(string $path): string
    {
        return app(ThemeService::class)->assetUrl($path);
    }
}

if (! function_exists('theme_view')) {
    function theme_view(string $view, array $data = []): View
    {
        return view(app(ThemeService::class)->view($view), $data);
    }
}

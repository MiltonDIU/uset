<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class PageController extends Controller
{
    public function index(): View
    {
        return theme_view('pages.home');
    }

    public function show(string $slug): View
    {
        // Try to find a view matching the slug in the current theme's pages directory
        $view = app(\Modules\Theme\app\Services\ThemeService::class)->view('pages.' . $slug);

        if (view()->exists($view)) {
            return theme_view('pages.' . $slug);
        }

        abort(404);
    }
}

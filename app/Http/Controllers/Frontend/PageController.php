<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Modules\CMS\app\Models\Page;
use Illuminate\View\View;

class PageController extends Controller
{
    public function index(): View
    {
        $page = Page::where('slug', 'home')->where('is_published', true)->first();

        return theme_view('pages.home', compact('page'));
    }

    public function show(string $slug): View
    {
        $page = Page::where('slug', $slug)->where('is_published', true)->first();

        // Try to find a view matching the slug in the current theme's pages directory
        $view = app(\Modules\Theme\app\Services\ThemeService::class)->view('pages.' . $slug);

        if (view()->exists($view)) {
            return theme_view('pages.' . $slug, compact('page'));
        }

        if ($page) {
            return theme_view('pages.home', compact('page'));
        }

        abort(404);
    }
}

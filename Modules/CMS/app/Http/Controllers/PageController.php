<?php

namespace Modules\CMS\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\CMS\app\Models\Page;
use Modules\Theme\app\Services\ThemeService;

class PageController extends Controller
{
    public function __construct(protected ThemeService $themeService) {}

    public function home()
    {
        $page = Page::where('slug', 'home')->where('is_published', true)->first();

        $view = $page && $page->template ? $page->template : 'home';

        return view($this->themeService->view('pages.'.$view), compact('page'));
    }

    public function show($slug)
    {
        $page = Page::where('slug', $slug)->where('is_published', true)->firstOrFail();

        $view = $page->template ?? 'home';

        return view($this->themeService->view('pages.'.$view), compact('page'));
    }
}

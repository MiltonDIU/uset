<?php

namespace Modules\CMS\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\CMS\app\Models\Page;
use Modules\Theme\app\Services\ThemeService;

class PageController extends Controller
{
    public function __construct(protected ThemeService $themeService)
    {
    }

    public function home()
    {
        $page = Page::where('slug', 'home')->where('is_published', true)->first();

        if ($page) {
            return view($this->themeService->view('pages.home'), compact('page'));
        }

        return view($this->themeService->view('pages.home'));
    }

    public function show($slug)
    {
        $page = Page::where('slug', $slug)->where('is_published', true)->firstOrFail();

        return view($this->themeService->view('pages.home'), compact('page'));
    }
}

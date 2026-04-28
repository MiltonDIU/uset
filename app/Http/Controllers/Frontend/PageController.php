<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Modules\CMS\app\Models\Page;
use Modules\News\app\Models\News;
use Modules\News\app\Services\NewsService;
use Modules\Events\app\Models\Event;
use Modules\Events\app\Services\EventService;
use Illuminate\View\View;

class PageController extends Controller
{
    public function index(): View
    {
        $page = Page::where('slug', 'home')->where('is_published', true)->first();

        return theme_view('pages.home', compact('page'));
    }

    public function show(string $slug, ?string $detail = null): View
    {
        $page = Page::where('slug', $slug)->where('is_published', true)->first();

        if (!$page) {
            abort(404);
        }

        $template = $page->template ?? 'default';

        // Handle module detail pages (e.g. /news/article-slug, /events/event-slug)
        if ($detail) {
            return $this->handleDetailPage($page, $template, $detail);
        }

        // Try to find a view matching the template in the current theme
        $templateViewName = str_replace('_', '-', $template);
        $view = app(\Modules\Theme\app\Services\ThemeService::class)->view('pages.' . $templateViewName);

        if (view()->exists($view)) {
            return theme_view('pages.' . $templateViewName, compact('page'));
        }

        // Fallback: try slug-based view
        $slugView = app(\Modules\Theme\app\Services\ThemeService::class)->view('pages.' . $slug);
        if (view()->exists($slugView)) {
            return theme_view('pages.' . $slug, compact('page'));
        }

        if ($page) {
            return theme_view('pages.default', compact('page'));
        }

        abort(404);
    }

    /**
     * Handle detail pages for module-linked templates.
     * e.g. /news/article-slug → loads News model, renders news detail view
     * e.g. /events/event-slug → loads Event model, renders event detail view
     */
    protected function handleDetailPage(Page $page, string $template, string $detail): View
    {
        return match ($template) {
            'news_listing' => $this->renderNewsDetail($page, $detail),
            'event_listing' => $this->renderEventDetail($page, $detail),
            'news_events' => $this->renderModuleDetail($page, $detail),
            default => abort(404),
        };
    }

    protected function renderModuleDetail(Page $page, string $slug): View
    {
        // Try News first
        $news = News::where('slug', $slug)->where('status', 'published')->first();
        if ($news) {
            return $this->renderNewsDetail($page, $slug);
        }

        // Then try Events
        $event = Event::where('slug', $slug)->where('is_published', true)->first();
        if ($event) {
            return $this->renderEventDetail($page, $slug);
        }

        abort(404);
    }

    protected function renderNewsDetail(Page $page, string $slug): View
    {
        $news = News::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        $relatedNews = News::where('status', 'published')
            ->where('id', '!=', $news->id)
            ->where('news_category_id', $news->news_category_id)
            ->latest('news_date')
            ->limit(3)
            ->get();

        $recentNews = app(NewsService::class)->getLatestNews(5);

        return theme_view('pages.news-detail', compact('page', 'news', 'relatedNews', 'recentNews'));
    }

    protected function renderEventDetail(Page $page, string $slug): View
    {
        $event = Event::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        $relatedEvents = Event::where('is_published', true)
            ->where('id', '!=', $event->id)
            ->where('event_category_id', $event->event_category_id)
            ->orderBy('event_date', 'asc')
            ->limit(3)
            ->get();

        $upcomingEvents = app(EventService::class)->getUpcomingEvents(5);

        return theme_view('pages.event-detail', compact('page', 'event', 'relatedEvents', 'upcomingEvents'));
    }
}

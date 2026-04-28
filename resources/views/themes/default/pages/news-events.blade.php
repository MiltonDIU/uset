@extends(app(\Modules\Theme\app\Services\ThemeService::class)->view('layouts.master'))

@section('title', 'News & Events | USET')

@push('styles')
<link rel="stylesheet" href="{{ theme_asset('css/news-events.css') }}" />
@endpush

@push('scripts')
<script src="{{ theme_asset('js/news-events.js') }}"></script>
@endpush

@section('content')
    @php
        $newsService = app(\Modules\News\app\Services\NewsService::class);
        $eventService = app(\Modules\Events\app\Services\EventService::class);
        
        $featuredNews = $newsService->getFeaturedNews(1)->first();
        $latestNews = \Modules\News\app\Models\News::where('status', 'published')->latest('news_date')->limit(3)->get();
        $upcomingEvents = $eventService->getUpcomingEvents(6);
        $stats = [
            ['value' => '150+', 'label' => 'News Articles'],
            ['value' => '50+', 'label' => 'Events Held'],
            ['value' => '10k+', 'label' => 'Readers'],
            ['value' => '25+', 'label' => 'Faculties'],
        ];
    @endphp

    <!-- Page Hero -->
    @include('themes.default.partials.page-hero', [
        'title' => 'News & Events',
        'description' => 'Stay updated with the latest happenings, academic news, and upcoming events at USET.'
    ])

    <!-- Featured News -->
    @include('themes.default.sections.news_featured', ['content' => ['count' => 1, 'show_newsletter' => true]])

    <!-- Stats Section -->
    @include('themes.default.sections.statistics', ['content' => ['items' => $stats]])

    <!-- News Grid (Latest Updates) -->
    @include('themes.default.sections.news_grid', ['content' => ['title' => 'Latest Updates', 'count' => 3, 'show_category_filter' => false, 'show_pagination' => false]])

    <!-- Events Section -->
    @include('themes.default.sections.event_list', ['content' => ['title' => 'Upcoming Events', 'count' => 6]])

    <!-- News Grid (Recent News with Filter) -->
    @include('themes.default.sections.news_grid', ['content' => ['title' => 'Recent News', 'count' => 6, 'show_category_filter' => true, 'show_pagination' => true]])

@endsection

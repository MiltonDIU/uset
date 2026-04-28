@php
    $newsService = app(\Modules\News\app\Services\NewsService::class);
    $eventService = app(\Modules\Events\app\Services\EventService::class);
    $newsCount = (int) ($content['news_count'] ?? 3);
    $eventCount = (int) ($content['event_count'] ?? 3);
    $recentNews = $newsService->getLatestNews($newsCount);
    $upcomingEvents = $eventService->getUpcomingEvents($eventCount);
    
    $newsPage = \Modules\CMS\app\Models\Page::whereIn('template', ['news_listing', 'news_events'])->where('is_published', true)->first();
    $newsRouteSlug = $newsPage ? $newsPage->slug : 'news';
    
    $eventPage = \Modules\CMS\app\Models\Page::whereIn('template', ['event_listing', 'news_events'])->where('is_published', true)->first();
    $eventRouteSlug = $eventPage ? $eventPage->slug : 'events';
@endphp

<section class="py-5 bg-white">
    <div class="container">
        <div class="row">
            {{-- News Column --}}
            <div class="col-lg-6 mb-5 mb-lg-0">
                <h2 class="section-heading mb-4">Latest News</h2>
                @forelse($recentNews as $news)
                <div class="card mb-3 fade-in-up ne-animate-item">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            @if($news->getFirstMediaUrl('featured_image'))
                                <img src="{{ $news->getFirstMediaUrl('featured_image') }}" alt="{{ $news->title }}" class="rounded mr-3" style="width: 80px; height: 80px; object-fit: cover;">
                            @else
                                <div class="bg-light rounded mr-3 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                    <i class="fas fa-newspaper text-muted"></i>
                                </div>
                            @endif
                            <div>
                                <div class="text-success small font-weight-bold mb-1">{{ $news->news_date?->format('M d, Y') }}</div>
                                <h6 class="font-weight-bold mb-1">
                                    <a href="/{{ $newsRouteSlug }}/{{ $news->slug }}" class="text-dark">{{ Str::limit($news->title, 60) }}</a>
                                </h6>
                                <p class="small text-muted mb-0">{{ Str::limit(strip_tags($news->content), 80) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-muted">No news available.</p>
                @endforelse
                <a href="/{{ $newsRouteSlug }}" class="btn btn-link text-success p-0 mt-2 font-weight-bold">View All News <i class="fas fa-arrow-right ml-1"></i></a>
            </div>

            {{-- Events Column --}}
            <div class="col-lg-6">
                <h2 class="section-heading mb-4">Upcoming Events</h2>
                @forelse($upcomingEvents as $event)
                <div class="card mb-3 fade-in-up ne-animate-item">
                    <div class="card-body p-3">
                        <div class="calendar-item">
                            <div class="calendar-date mr-3 text-center" style="min-width: 60px;">
                                <span class="h4 font-weight-bold mb-0 d-block">{{ $event->event_date->format('d') }}</span>
                                <span class="small text-uppercase">{{ $event->event_date->format('M') }}</span>
                            </div>
                            <div class="border-left pl-3">
                                <h6 class="font-weight-bold mb-1">
                                    <a href="/{{ $eventRouteSlug }}/{{ $event->slug }}" class="text-dark">{{ Str::limit($event->title, 60) }}</a>
                                </h6>
                                <p class="small text-muted mb-0">
                                    <i class="fas fa-map-marker-alt mr-1"></i> {{ $event->venue ?? 'Main Campus' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-muted">No upcoming events.</p>
                @endforelse
                <a href="/{{ $eventRouteSlug }}" class="btn btn-link text-success p-0 mt-2 font-weight-bold">View All Events <i class="fas fa-arrow-right ml-1"></i></a>
            </div>
        </div>
    </div>
</section>

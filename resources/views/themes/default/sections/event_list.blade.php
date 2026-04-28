@php
    $eventService = app(\Modules\Events\app\Services\EventService::class);
    $count = (int) ($content['count'] ?? 6);
    $showType = $content['show_type'] ?? 'upcoming';

    $events = match($showType) {
        'upcoming' => $eventService->getUpcomingEvents($count),
        'past' => $eventService->getRecentEvents($count),
        default => \Modules\Events\app\Models\Event::where('is_published', true)->orderBy('event_date', 'desc')->limit($count)->get(),
    };

    $categories = \Modules\Events\app\Models\EventCategory::where('is_active', true)->get();
@endphp

<section class="py-5 bg-white" id="events-section">
    <div class="container">
        @if(!empty($content['title']))
            <h2 class="section-heading text-center">{{ $content['title'] }}</h2>
        @else
            <h2 class="section-heading text-center">Upcoming Events</h2>
        @endif

        <div class="d-flex justify-content-center mb-5 flex-wrap">
            <a href="{{ request()->url() }}#events-section" class="filter-btn active">All Events</a>
            @foreach($categories as $cat)
                <button class="filter-btn">{{ $cat->name }}</button>
            @endforeach
        </div>

        <div class="row">
            @forelse($events as $event)
            <div class="col-lg-4 mb-4 ne-animate-item">
                <div class="card calendar-card h-100 fade-in-up">
                    <div class="card-body">
                        <div class="calendar-item">
                            <div class="calendar-date mr-3 text-center" style="min-width: 80px;">
                                <span class="h2 font-weight-bold mb-0 d-block">{{ $event->event_date->format('d') }}</span>
                                <span class="text-uppercase">{{ $event->event_date->format('M') }}</span>
                            </div>
                            <div>
                                <h5 class="font-weight-bold mb-1">{{ Str::limit($event->title, 40) }}</h5>
                                <p class="text-muted small mb-0">
                                    <i class="fas fa-map-marker-alt mr-1"></i> {{ $event->venue ?? 'Main Campus' }}
                                </p>
                            </div>
                        </div>
                        <p class="mt-3 text-muted small">
                            {{ Str::limit(strip_tags($event->description), 80) }}
                        </p>
                        <a href="/events/{{ $event->slug }}" class="btn btn-outline-success btn-block mt-3">View Details</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">No events found.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

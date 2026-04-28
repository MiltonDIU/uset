@extends(app(\Modules\Theme\app\Services\ThemeService::class)->view('layouts.master'))

@section('title', 'Events | USET')

@push('styles')
<link rel="stylesheet" href="{{ theme_asset('css/news-events-v2.css') }}" />
@endpush

@section('content')
    @php
        $eventService = app(\Modules\Events\app\Services\EventService::class);
        $upcomingEvents = $eventService->getUpcomingEvents(10);
        $pastEvents = $eventService->getRecentEvents(6);
    @endphp

    @component('themes.default.partials.page-hero', [
        'title' => $page->title,
        'breadcrumbs' => [
            ['name' => $page->title, 'url' => '']
        ]
    ])
    @endcomponent

    <div class="container py-5">
        <div class="row">
            {{-- Upcoming Events --}}
            <div class="col-lg-8">
                <h3 class="ne-section-title">Upcoming Events</h3>
                
                @forelse($upcomingEvents as $event)
                    <div class="ne-event-card">
                        <div class="ne-event-date-box">
                            <span class="ne-event-day">{{ $event->event_date->format('d') }}</span>
                            <span class="ne-event-month">{{ $event->event_date->format('M') }}</span>
                        </div>
                        <div class="ne-event-info">
                            <h5>{{ $event->title }}</h5>
                            <div class="text-muted small mb-2">
                                <span class="mr-3"><i class="fas fa-clock mr-1 text-primary"></i> {{ $event->start_time ? \Carbon\Carbon::parse($event->start_time)->format('h:i A') : 'TBD' }}</span>
                                <span><i class="fas fa-map-marker-alt mr-1 text-primary"></i> {{ $event->venue ?? 'Main Campus' }}</span>
                            </div>
                            <p class="text-muted small mb-3">
                                {{ Str::limit(strip_tags($event->description), 150) }}
                            </p>
                            <a href="{{ url($page->slug . '/' . $event->slug) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">View Details</a>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-light text-center py-4 border">
                        <i class="far fa-calendar-times fa-2x mb-2 text-muted"></i>
                        <p class="mb-0">No upcoming events scheduled at the moment.</p>
                    </div>
                @endforelse

                {{-- Past Events Grid --}}
                <h3 class="ne-section-title mt-5">Past Events</h3>
                <div class="row">
                    @foreach($pastEvents as $event)
                        <div class="col-md-6 mb-4">
                            <div class="ne-card">
                                <div class="ne-card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="bg-light text-primary font-weight-bold px-3 py-1 rounded small mr-2">
                                            {{ $event->event_date->format('M Y') }}
                                        </div>
                                        <span class="badge badge-secondary">Past</span>
                                    </div>
                                    <h5 class="font-weight-bold">{{ Str::limit($event->title, 50) }}</h5>
                                    <p class="text-muted small mb-3">{{ Str::limit(strip_tags($event->description), 100) }}</p>
                                    <a href="{{ url($page->slug . '/' . $event->slug) }}" class="text-primary font-weight-bold small">Read Summary <i class="fas fa-arrow-right ml-1"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">
                <aside class="sticky-top" style="top: 120px;">
                    <div class="ne-sidebar-widget bg-primary text-white">
                        <h4 class="font-weight-bold mb-3">Host an Event?</h4>
                        <p class="small opacity-8">Are you a student or faculty member planning an activity? Contact the administration to get it listed.</p>
                        <a href="/contact" class="btn btn-light btn-sm btn-block font-weight-bold mt-3">Contact Admin</a>
                    </div>

                    <div class="ne-sidebar-widget">
                        <h4 class="ne-widget-title">Event Categories</h4>
                        <ul class="list-unstyled mb-0">
                            @foreach(\Modules\Events\app\Models\EventCategory::where('is_active', true)->get() as $cat)
                                <li class="mb-2 pb-2 border-bottom last-child-no-border">
                                    <a href="/{{ $page->slug }}?category={{ $cat->slug }}" class="text-dark d-flex justify-content-between align-items-center">
                                        {{ $cat->name }}
                                        <span class="badge badge-light badge-pill">{{ $cat->events()->count() }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </aside>
            </div>
        </div>
    </div>
@endsection

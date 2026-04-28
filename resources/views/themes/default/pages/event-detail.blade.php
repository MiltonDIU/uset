@extends(app(\Modules\Theme\app\Services\ThemeService::class)->view('layouts.master'))

@section('title', $event->title . ' | USET Events')

@push('styles')
<link rel="stylesheet" href="{{ theme_asset('css/news-events-v2.css') }}" />
@endpush

@section('content')
    <!-- Event Detail Hero -->
    <section class="ne-hero">
        <div class="container ne-hero-content">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="/events">Events</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Details</li>
                </ol>
            </nav>
            <h1 style="font-size: 2.75rem; line-height: 1.2;">{{ $event->title }}</h1>
        </div>
    </section>

    <div class="container py-5">
        <div class="row">
            {{-- Main Content --}}
            <div class="col-lg-8">
                <article class="ne-detail-header">
                    {{-- Event Header Card --}}
                    <div class="ne-sidebar-widget mb-5 p-0 overflow-hidden">
                        <div class="row no-gutters">
                            <div class="col-md-4 bg-primary text-white d-flex flex-column align-items-center justify-content-center py-4">
                                <span style="font-size: 4rem; font-weight: 800; line-height: 1;">{{ $event->event_date->format('d') }}</span>
                                <span style="font-size: 1.5rem; font-weight: 700; text-transform: uppercase;">{{ $event->event_date->format('M Y') }}</span>
                            </div>
                            <div class="col-md-8 p-4">
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-3 d-flex align-items-center">
                                        <i class="fas fa-clock mr-3 text-primary fa-lg" style="width: 25px;"></i>
                                        <div>
                                            <strong class="d-block">Time</strong>
                                            <span>{{ $event->start_time ? \Carbon\Carbon::parse($event->start_time)->format('h:i A') : 'To Be Announced' }}</span>
                                        </div>
                                    </li>
                                    <li class="mb-3 d-flex align-items-center">
                                        <i class="fas fa-map-marker-alt mr-3 text-primary fa-lg" style="width: 25px;"></i>
                                        <div>
                                            <strong class="d-block">Location</strong>
                                            <span>{{ $event->venue ?? 'University Campus' }}</span>
                                        </div>
                                    </li>
                                    @if($event->organizer)
                                    <li class="d-flex align-items-center">
                                        <i class="fas fa-university mr-3 text-primary fa-lg" style="width: 25px;"></i>
                                        <div>
                                            <strong class="d-block">Organizer</strong>
                                            <span>{{ $event->organizer }}</span>
                                        </div>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="ne-content">
                        <h4 class="ne-section-title">Event Description</h4>
                        {!! $event->description !!}
                    </div>

                    {{-- Gallery --}}
                    @if($event->getMedia('gallery')->count() > 0)
                        <div class="mt-5 pt-5 border-top">
                            <h4 class="ne-widget-title">Event Photos</h4>
                            <div class="row">
                                @foreach($event->getMedia('gallery') as $media)
                                    <div class="col-md-4 col-6 mb-4">
                                        <a href="{{ $media->getUrl() }}" target="_blank" class="rounded overflow-hidden d-block shadow-sm">
                                            <img src="{{ $media->getUrl() }}" class="w-100" style="height: 150px; object-fit: cover;" alt="Gallery">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </article>
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">
                <aside class="sticky-top" style="top: 120px;">
                    {{-- Registration/Action --}}
                    <div class="ne-sidebar-widget text-center">
                        <h5 class="font-weight-bold mb-3">Interested in this event?</h5>
                        <p class="small text-muted mb-4">Join us for this exciting activity at USET. No pre-registration required unless specified.</p>
                        <button class="btn btn-primary btn-block rounded-pill py-2">Add to Calendar</button>
                    </div>

                    {{-- Upcoming Events --}}
                    <div class="ne-sidebar-widget">
                        <h4 class="ne-widget-title">Other Events</h4>
                        @foreach($upcomingEvents ?? [] as $recent)
                            @if($recent->id != $event->id)
                            <div class="media mb-4 align-items-center">
                                <div class="bg-light text-primary font-weight-bold px-2 py-2 rounded text-center mr-3" style="min-width: 50px;">
                                    {{ $recent->event_date->format('M d') }}
                                </div>
                                <div class="media-body">
                                    <h6 class="mt-0 mb-0 font-weight-bold" style="font-size: 0.9rem;">
                                        <a href="/events/{{ $recent->slug }}" class="text-dark">{{ Str::limit($recent->title, 45) }}</a>
                                    </h6>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </aside>
            </div>
        </div>
    </div>
@endsection

@extends(app(\Modules\Theme\app\Services\ThemeService::class)->view('layouts.master'))

@section('title', $event->title . ' | USET Events')

@push('styles')
<link rel="stylesheet" href="{{ theme_asset('css/premium-news-events.css') }}" />
@endpush

@push('scripts')
<script src="{{ theme_asset('js/premium-animations.js') }}"></script>
@endpush

@section('content')
    <!-- Premium Event Hero -->
    <section class="premium-hero" style="padding: 120px 0 80px;">
        <div class="container text-center">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center bg-transparent p-0 mb-4">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="/news-events">News & Events</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Event Details</li>
                </ol>
            </nav>
            <h1 class="display-4 font-weight-bold mb-4 mx-auto" style="max-width: 900px;">{{ $event->title }}</h1>
            <div class="d-flex justify-content-center align-items-center flex-wrap gap-4 text-white opacity-75">
                <span><i class="far fa-calendar-alt mr-2"></i> {{ $event->event_date->format('F d, Y') }}</span>
                <span><i class="far fa-clock mr-2"></i> {{ $event->start_time }} - {{ $event->end_time }}</span>
                <span><i class="fas fa-map-marker-alt mr-2"></i> {{ $event->venue }}</span>
            </div>
        </div>
    </section>

    <div class="container py-5 mt-n5">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <div class="glass-card p-4 p-md-5 mb-5 fade-in-up">
                    <!-- Featured Image -->
                    @if($event->getFirstMediaUrl('featured_image'))
                    <div class="rounded-lg overflow-hidden mb-5 shadow-lg">
                        <img src="{{ $event->getFirstMediaUrl('featured_image') }}" alt="{{ $event->title }}" class="w-100">
                    </div>
                    @endif

                    <!-- Event Description -->
                    <div class="detail-content">
                        <h3 class="font-weight-bold mb-4">About the Event</h3>
                        {!! $event->description !!}
                    </div>

                    <!-- Event Details Grid -->
                    <div class="row mt-5">
                        <div class="col-md-6 mb-4">
                            <div class="p-4 rounded-lg bg-light h-100">
                                <h5 class="font-weight-bold mb-3 text-primary"><i class="fas fa-info-circle mr-2"></i>Organizer Info</h5>
                                <p class="mb-1"><strong>Organizer:</strong> {{ $event->organizer ?? 'USET Administration' }}</p>
                                <p class="mb-0"><strong>Contact:</strong> {{ $event->contact_person ?? 'info@uset.ac' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="p-4 rounded-lg bg-light h-100">
                                <h5 class="font-weight-bold mb-3 text-primary"><i class="fas fa-map-marked-alt mr-2"></i>Venue Details</h5>
                                <p class="mb-0">{{ $event->venue }}</p>
                                <small class="text-muted">Please arrive 15 minutes before the start time.</small>
                            </div>
                        </div>
                    </div>

                    <!-- Social Share -->
                    <div class="mt-4 p-4 rounded-lg bg-light d-flex align-items-center justify-content-between flex-wrap gap-3">
                        <h5 class="mb-0 font-weight-bold">Share with friends:</h5>
                        <div class="d-flex gap-2">
                            <a href="#" class="btn btn-outline-primary rounded-circle"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="btn btn-outline-info rounded-circle"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="btn btn-outline-secondary rounded-circle"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <aside class="sidebar-sticky">
                    <!-- Event Registration CTA -->
                    <div class="glass-card p-4 mb-4 fade-in-up text-center" style="background: var(--primary-gradient) !important; color: white;">
                        <h4 class="font-weight-bold mb-3">Join this Event</h4>
                        <p class="opacity-75 mb-4">Don't miss out on this amazing opportunity to learn and grow.</p>
                        <button class="btn btn-light btn-block rounded-pill font-weight-bold py-3">Register Now</button>
                    </div>

                    <!-- Upcoming Events Widget -->
                    <div class="glass-card p-4 mb-4 fade-in-up" style="animation-delay: 0.1s">
                        <h4 class="widget-title">Other Events</h4>
                        @php $otherEvents = \Modules\Events\app\Models\Event::where('is_published', true)->where('id', '!=', $event->id)->where('event_date', '>=', now())->orderBy('event_date')->limit(3)->get(); @endphp
                        @foreach($otherEvents as $other)
                        <div class="d-flex mb-4 align-items-center">
                            <div class="bg-primary text-white text-center rounded px-2 py-1 mr-3" style="min-width: 50px;">
                                <div class="font-weight-bold" style="font-size: 1.2rem;">{{ $other->event_date->format('d') }}</div>
                                <div class="small text-uppercase">{{ $other->event_date->format('M') }}</div>
                            </div>
                            <div>
                                <h6 class="mb-1 line-clamp-2"><a href="/events/{{ $other->slug }}" class="text-dark font-weight-bold">{{ $other->title }}</a></h6>
                                <small class="text-muted"><i class="fas fa-map-marker-alt mr-1"></i> {{ Str::limit($other->venue, 20) }}</small>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Location Map Placeholder -->
                    <div class="glass-card overflow-hidden fade-in-up" style="animation-delay: 0.2s">
                        <div style="height: 250px; background: #eee; display: flex; align-items: center; justify-content: center;">
                             <div class="text-center text-muted">
                                 <i class="fas fa-map-marked-alt fa-3x mb-3"></i>
                                 <p>Map View Loading...</p>
                             </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
@endsection

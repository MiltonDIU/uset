@extends(app(\Modules\Theme\app\Services\ThemeService::class)->view('layouts.master'))

@section('title', 'News & Events | USET')

@push('styles')
<link rel="stylesheet" href="{{ theme_asset('css/premium-news-events.css') }}" />
@endpush

@push('scripts')
<script src="{{ theme_asset('js/premium-animations.js') }}"></script>
@endpush

@section('content')
    <!-- Premium Hero Section -->
    <section class="premium-hero">
        <div class="container text-center">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center bg-transparent p-0 mb-4">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">News & Events</li>
                </ol>
            </nav>
            <h1 class="display-4 font-weight-bold mb-3">Campus Buzz & Global Updates</h1>
            <p class="lead opacity-75 mx-auto" style="max-width: 700px;">
                Stay connected with the latest academic breakthroughs, campus events, and student success stories at USET.
            </p>
        </div>
    </section>

    <div class="container mb-5">
        <div class="featured-split">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Featured News Card -->
                    @php $featured = \Modules\News\app\Models\News::where('is_featured', true)->where('status', 'published')->first(); @endphp
                    @if($featured)
                    <div class="glass-card mb-4 fade-in-up">
                        <div class="row no-gutters">
                            <div class="col-md-6">
                                <div class="ne-card-image h-100" style="min-height: 300px;">
                                    <img src="{{ $featured->getFirstMediaUrl('featured_image') ?: theme_asset('img/new_banner_1.jpeg') }}" alt="{{ $featured->title }}">
                                    <span class="ne-category-badge">Featured Story</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="ne-card-content d-flex flex-column h-100 justify-content-center">
                                    <div class="ne-card-meta">
                                        <span><i class="far fa-calendar-alt"></i> {{ $featured->news_date?->format('M d, Y') ?: $featured->created_at->format('M d, Y') }}</span>
                                        <span><i class="far fa-folder"></i> {{ $featured->category->name ?? 'General' }}</span>
                                    </div>
                                    <h2 class="ne-card-title h3">{{ $featured->title }}</h2>
                                    <p class="text-muted mb-4">{{ Str::limit($featured->short_description, 120) }}</p>
                                    <a href="/news/{{ $featured->slug }}" class="btn btn-primary align-self-start rounded-pill px-4">Read Full Article</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="col-lg-4">
                    <!-- Newsletter Glass Card -->
                    <div class="glass-card bg-primary text-white h-100 fade-in-up" style="animation-delay: 0.2s; background: var(--primary-gradient) !important;">
                        <div class="ne-card-content text-center d-flex flex-column justify-content-center h-100">
                            <div class="mb-4"><i class="fas fa-paper-plane fa-3x opacity-50"></i></div>
                            <h3>Subscribe to Newsletter</h3>
                            <p class="opacity-75 mb-4">Join 5,000+ subscribers and get the latest updates directly in your inbox.</p>
                            <form action="#" class="px-3">
                                <div class="form-group mb-3">
                                    <input type="email" class="form-control rounded-pill border-0 px-4 py-4" placeholder="Your Email Address">
                                </div>
                                <button class="btn btn-light btn-block rounded-pill font-weight-bold py-2">Join Now</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Latest News Grid -->
    <section class="py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end mb-5">
                <div>
                    <span class="text-primary font-weight-bold text-uppercase tracking-wider">Updates</span>
                    <h2 class="font-weight-bold">Latest News</h2>
                </div>
                <a href="/news" class="btn btn-outline-primary rounded-pill px-4">View All News</a>
            </div>
            
            <div class="row">
                @php $latestNews = \Modules\News\app\Models\News::where('status', 'published')->latest('news_date')->limit(3)->get(); @endphp
                @foreach($latestNews as $news)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="glass-card h-100 fade-in-up" style="animation-delay: {{ $loop->index * 0.1 }}s">
                        <div class="ne-card-image">
                            <img src="{{ $news->getFirstMediaUrl('featured_image') ?: 'https://via.placeholder.com/600x400?text=News' }}" alt="{{ $news->title }}">
                            <span class="ne-category-badge">{{ $news->category->name ?? 'News' }}</span>
                        </div>
                        <div class="ne-card-content">
                            <div class="ne-card-meta">
                                <span><i class="far fa-calendar-alt"></i> {{ $news->news_date?->format('M d, Y') }}</span>
                            </div>
                            <h3 class="ne-card-title">{{ $news->title }}</h3>
                            <p class="text-muted small mb-4">{{ Str::limit($news->short_description, 90) }}</p>
                            <a href="/news/{{ $news->slug }}" class="font-weight-bold text-primary">Read More <i class="fas fa-arrow-right ml-1"></i></a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Events Section - Dark Themed for Contrast -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end mb-5">
                <div>
                    <span class="text-primary font-weight-bold text-uppercase tracking-wider">Calendar</span>
                    <h2 class="font-weight-bold">Upcoming Events</h2>
                </div>
                <a href="/events" class="btn btn-outline-primary rounded-pill px-4">View All Events</a>
            </div>

            <div class="row">
                @php $upcomingEvents = \Modules\Events\app\Models\Event::where('is_published', true)->where('event_date', '>=', now())->orderBy('event_date')->limit(4)->get(); @endphp
                @foreach($upcomingEvents as $event)
                <div class="col-lg-6 mb-4">
                    <div class="glass-card fade-in-up" style="animation-delay: {{ $loop->index * 0.1 }}s">
                        <div class="row no-gutters">
                            <div class="col-sm-4">
                                <div class="bg-primary text-white h-100 d-flex flex-column align-items-center justify-content-center p-4" style="background: var(--primary-gradient) !important;">
                                    <span class="display-4 font-weight-bold mb-0">{{ $event->event_date->format('d') }}</span>
                                    <span class="text-uppercase font-weight-bold tracking-wider">{{ $event->event_date->format('M Y') }}</span>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="ne-card-content">
                                    <div class="ne-card-meta">
                                        <span><i class="far fa-clock"></i> {{ $event->start_time }} - {{ $event->end_time }}</span>
                                    </div>
                                    <h3 class="ne-card-title h5">{{ $event->title }}</h3>
                                    <p class="text-muted small mb-3"><i class="fas fa-map-marker-alt mr-1"></i> {{ $event->venue }}</p>
                                    <a href="/events/{{ $event->slug }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">Join Event</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Submission CTA -->
    <section class="py-5 text-center">
        <div class="container py-4">
            <div class="glass-card p-5 fade-in-up">
                <h2 class="font-weight-bold mb-3">Have a story to share?</h2>
                <p class="lead text-muted mb-4 mx-auto" style="max-width: 600px;">
                    We're always looking for exciting news and events from our community. Submit your story today!
                </p>
                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <a href="/submit-news" class="btn btn-primary rounded-pill px-5 py-2 mx-2">Submit News</a>
                    <a href="/submit-event" class="btn btn-outline-primary rounded-pill px-5 py-2 mx-2">Submit Event</a>
                </div>
            </div>
        </div>
    </section>
@endsection

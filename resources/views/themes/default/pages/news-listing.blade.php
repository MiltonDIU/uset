@extends(app(\Modules\Theme\app\Services\ThemeService::class)->view('layouts.master'))

@section('title', 'News & Updates | USET')

@push('styles')
<link rel="stylesheet" href="{{ theme_asset('css/news-events-v2.css') }}" />
@endpush

@section('content')
    @php
        $newsService = app(\Modules\News\app\Services\NewsService::class);
        $featuredNews = $newsService->getFeaturedNews(1)->first();
        $latestNews = \Modules\News\app\Models\News::where('status', 'published')
            ->where('id', '!=', $featuredNews?->id)
            ->latest('news_date')
            ->paginate(9);
    @endphp

    <!-- Premium Hero Section -->
    <section class="ne-hero">
        <div class="container ne-hero-content">
            <h1 class="fade-in">News & Updates</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">News</li>
                </ol>
            </nav>
        </div>
    </section>

    <div class="container py-5">
        {{-- Featured News --}}
        @if($featuredNews)
            <div class="ne-featured-card">
                <div class="ne-featured-img">
                    @if($featuredNews->getFirstMediaUrl('featured_image'))
                        <img src="{{ $featuredNews->getFirstMediaUrl('featured_image') }}" alt="{{ $featuredNews->title }}">
                    @else
                        <img src="https://via.placeholder.com/800x600?text=USET+News" alt="Placeholder">
                    @endif
                </div>
                <div class="ne-featured-body">
                    <span class="ne-badge">Featured Article</span>
                    <h2 class="ne-featured-title">{{ $featuredNews->title }}</h2>
                    <p class="text-muted lead mb-4">
                        {{ Str::limit($featuredNews->short_description ?? strip_tags($featuredNews->content), 200) }}
                    </p>
                    <div class="d-flex align-items-center mb-4 text-muted small">
                        <i class="fas fa-calendar-alt mr-2 text-primary"></i> {{ $featuredNews->news_date?->format('F d, Y') }}
                        <span class="mx-3">|</span>
                        <i class="fas fa-user mr-2 text-primary"></i> Administration
                    </div>
                    <div>
                        <a href="/news/{{ $featuredNews->slug }}" class="btn btn-primary btn-lg rounded-pill px-5">
                            Read Full Story <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        @endif

        {{-- Latest News Grid --}}
        <h3 class="ne-section-title">Latest Updates</h3>
        <div class="row">
            @forelse($latestNews as $news)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="ne-card">
                        <div class="ne-card-img">
                            @if($news->getFirstMediaUrl('featured_image'))
                                <img src="{{ $news->getFirstMediaUrl('featured_image') }}" alt="{{ $news->title }}">
                            @else
                                <img src="https://via.placeholder.com/400x300?text=News" alt="Placeholder">
                            @endif
                            @if($news->category)
                                <div style="position: absolute; top: 15px; left: 15px;">
                                    <span class="badge badge-primary px-3 py-2">{{ $news->category->name }}</span>
                                </div>
                            @endif
                        </div>
                        <div class="ne-card-body">
                            <div class="ne-card-date">
                                <i class="fas fa-calendar-alt"></i> {{ $news->news_date?->format('M d, Y') }}
                            </div>
                            <h4 class="ne-card-title">
                                <a href="/news/{{ $news->slug }}" class="text-dark text-decoration-none">{{ Str::limit($news->title, 70) }}</a>
                            </h4>
                            <p class="text-muted small">
                                {{ Str::limit($news->short_description ?? strip_tags($news->content), 120) }}
                            </p>
                            <div class="mt-auto pt-3">
                                <a href="/news/{{ $news->slug }}" class="btn btn-link text-primary p-0 font-weight-bold">
                                    Read More <i class="fas fa-chevron-right ml-1 small"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted">No news updates available at this time.</p>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-5">
            {{ $latestNews->links() }}
        </div>
    </div>
@endsection

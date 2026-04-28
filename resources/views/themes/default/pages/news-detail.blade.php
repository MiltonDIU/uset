@extends(app(\Modules\Theme\app\Services\ThemeService::class)->view('layouts.master'))

@section('title', $news->title . ' | USET News')

@push('styles')
<link rel="stylesheet" href="{{ theme_asset('css/news-events-v2.css') }}" />
<style>
    .ne-content p { margin-bottom: 1.5rem; }
    .ne-content img { max-width: 100%; border-radius: 12px; margin: 2rem 0; }
    .ne-content h2, .ne-content h3 { margin-top: 2rem; color: var(--primary-dark); font-weight: 700; }
</style>
@endpush

@section('content')
    <!-- Detail Hero -->
    <section class="ne-hero">
        <div class="container ne-hero-content">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="/news">News</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Article</li>
                </ol>
            </nav>
            <h1 style="font-size: 2.75rem; line-height: 1.2;">{{ $news->title }}</h1>
        </div>
    </section>

    <div class="container py-5">
        <div class="row">
            {{-- Main Content --}}
            <div class="col-lg-8">
                <article class="ne-detail-header">
                    {{-- Featured Image --}}
                    @if($news->getFirstMediaUrl('featured_image'))
                        <div class="mb-4 rounded shadow-lg overflow-hidden" style="max-height: 500px;">
                            <img src="{{ $news->getFirstMediaUrl('featured_image') }}" alt="{{ $news->title }}" class="w-100" style="object-fit: cover;">
                        </div>
                    @endif

                    {{-- Meta Info --}}
                    <div class="ne-detail-meta">
                        <div class="ne-meta-item">
                            <i class="fas fa-calendar-alt"></i>
                            {{ $news->news_date?->format('F d, Y') }}
                        </div>
                        @if($news->category)
                            <div class="ne-meta-item">
                                <i class="fas fa-tag"></i>
                                {{ $news->category->name }}
                            </div>
                        @endif
                        <div class="ne-meta-item">
                            <i class="fas fa-user"></i>
                            Admin
                        </div>
                    </div>

                    {{-- Article Content --}}
                    <div class="ne-content">
                        {!! $news->content !!}
                    </div>

                    {{-- Gallery --}}
                    @if($news->getMedia('gallery')->count() > 0)
                        <div class="mt-5 pt-5 border-top">
                            <h4 class="ne-widget-title">Event Gallery</h4>
                            <div class="row">
                                @foreach($news->getMedia('gallery') as $media)
                                    <div class="col-md-4 col-6 mb-4">
                                        <a href="{{ $media->getUrl() }}" target="_blank" class="rounded overflow-hidden d-block shadow-sm">
                                            <img src="{{ $media->getUrl() }}" class="w-100" style="height: 150px; object-fit: cover;" alt="Gallery">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Social Share --}}
                    <div class="mt-5 p-4 bg-light rounded-lg d-flex align-items-center justify-content-between">
                        <h5 class="mb-0 font-weight-bold">Share this story:</h5>
                        <div class="d-flex gap-2">
                            <a href="https://facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" class="btn btn-outline-primary rounded-circle mx-1" target="_blank"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}" class="btn btn-outline-info rounded-circle mx-1" target="_blank"><i class="fab fa-twitter"></i></a>
                            <a href="https://linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->url()) }}" class="btn btn-outline-secondary rounded-circle mx-1" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </article>
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">
                <aside class="sticky-top" style="top: 120px;">
                    {{-- Search Widget --}}
                    <div class="ne-sidebar-widget">
                        <h4 class="ne-widget-title">Search News</h4>
                        <form action="/news" method="GET">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Search articles...">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>

                    {{-- Recent News --}}
                    <div class="ne-sidebar-widget">
                        <h4 class="ne-widget-title">Recent Updates</h4>
                        @foreach($recentNews ?? [] as $recent)
                            <div class="media mb-4 align-items-center">
                                <img src="{{ $recent->getFirstMediaUrl('featured_image') ?: 'https://via.placeholder.com/80x80' }}" 
                                     class="mr-3 rounded" style="width: 70px; height: 70px; object-fit: cover;" alt="{{ $recent->title }}">
                                <div class="media-body">
                                    <h6 class="mt-0 mb-1 font-weight-bold" style="font-size: 0.9rem; line-height: 1.3;">
                                        <a href="/news/{{ $recent->slug }}" class="text-dark">{{ Str::limit($recent->title, 45) }}</a>
                                    </h6>
                                    <small class="text-muted"><i class="fas fa-calendar-alt mr-1"></i> {{ $recent->news_date?->format('M d') }}</small>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Categories --}}
                    <div class="ne-sidebar-widget">
                        <h4 class="ne-widget-title">Categories</h4>
                        <ul class="list-unstyled mb-0">
                            @foreach(\Modules\News\app\Models\NewsCategory::where('is_active', true)->get() as $cat)
                                <li class="mb-2 pb-2 border-bottom last-child-no-border">
                                    <a href="/news?category={{ $cat->slug }}" class="text-dark d-flex justify-content-between align-items-center">
                                        {{ $cat->name }}
                                        <span class="badge badge-light badge-pill">{{ $cat->news()->count() }}</span>
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

@extends(app(\Modules\Theme\app\Services\ThemeService::class)->view('layouts.master'))

@section('title', $news->title . ' | USET News')

@push('styles')
<link rel="stylesheet" href="{{ theme_asset('css/premium-news-events.css') }}" />
@endpush

@push('scripts')
<script src="{{ theme_asset('js/premium-animations.js') }}"></script>
@endpush

@section('content')
    @component('themes.default.partials.page-hero', [
        'title' => $news->title,
        'breadcrumbs' => [
            ['name' => $page->title, 'url' => '/' . $page->slug],
            ['name' => 'Article', 'url' => '']
        ]
    ])
        <div class="d-flex justify-content-center align-items-center gap-4 text-white opacity-75">
            <span><i class="far fa-calendar-alt mr-2"></i> {{ $news->news_date?->format('F d, Y') }}</span>
            <span><i class="far fa-folder mr-2"></i> {{ $news->category->name ?? 'General' }}</span>
            <span><i class="far fa-user mr-2"></i> Admin</span>
        </div>
    @endcomponent

    <div class="container py-5 mt-n5">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <div class="glass-card p-4 p-md-5 mb-5 fade-in-up">
                    <!-- Featured Image -->
                    @if($news->getFirstMediaUrl('featured_image'))
                    <div class="rounded-lg overflow-hidden mb-5 shadow-lg">
                        <img src="{{ $news->getFirstMediaUrl('featured_image') }}" alt="{{ $news->title }}" class="w-100">
                    </div>
                    @endif

                    <!-- Article Content -->
                    <div class="detail-content">
                        {!! $news->content !!}
                    </div>

                    <!-- Gallery Section -->
                    @if($news->getMedia('gallery')->count() > 0)
                    <div class="mt-5 pt-5 border-top">
                        <h3 class="widget-title mb-4">Event Gallery</h3>
                        <div class="row">
                            @foreach($news->getMedia('gallery') as $media)
                            <div class="col-md-4 col-6 mb-4">
                                <a href="{{ $media->getUrl() }}" target="_blank" class="rounded-lg overflow-hidden d-block shadow-sm h-100">
                                    <img src="{{ $media->getUrl() }}" class="w-100 h-100" style="object-fit: cover; min-height: 150px;" alt="Gallery Image">
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Social Share -->
                    <div class="mt-5 p-4 rounded-lg bg-light d-flex align-items-center justify-content-between flex-wrap gap-3">
                        <h5 class="mb-0 font-weight-bold">Spread the word:</h5>
                        <div class="d-flex gap-2">
                            <a href="#" class="btn btn-outline-primary rounded-circle"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="btn btn-outline-info rounded-circle"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="btn btn-outline-secondary rounded-circle"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" class="btn btn-outline-success rounded-circle"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <aside class="sidebar-sticky">
                    <!-- Search Widget -->
                    <div class="glass-card p-4 mb-4 fade-in-up" style="animation-delay: 0.1s">
                        <h4 class="widget-title">Search</h4>
                        <form action="/{{ $page->slug }}" method="GET">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control rounded-left border-right-0" placeholder="Search news...">
                                <div class="input-group-append">
                                    <button class="btn btn-primary rounded-right"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Recent News Widget -->
                    <div class="glass-card p-4 mb-4 fade-in-up" style="animation-delay: 0.2s">
                        <h4 class="widget-title">Recent Updates</h4>
                        @php $recentNews = \Modules\News\app\Models\News::where('status', 'published')->where('id', '!=', $news->id)->latest('news_date')->limit(4)->get(); @endphp
                        @foreach($recentNews as $recent)
                        <div class="d-flex mb-4 align-items-center">
                            <img src="{{ $recent->getFirstMediaUrl('featured_image') ?: 'https://via.placeholder.com/80x80' }}" class="rounded mr-3" style="width: 70px; height: 70px; object-fit: cover;">
                            <div>
                                <h6 class="mb-1 line-clamp-2"><a href="/{{ $page->slug }}/{{ $recent->slug }}" class="text-dark font-weight-bold">{{ $recent->title }}</a></h6>
                                <small class="text-muted"><i class="far fa-calendar-alt mr-1"></i> {{ $recent->news_date?->format('M d') }}</small>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Categories Widget -->
                    <div class="glass-card p-4 mb-4 fade-in-up" style="animation-delay: 0.3s">
                        <h4 class="widget-title">Categories</h4>
                        <ul class="list-unstyled mb-0">
                            @foreach(\Modules\News\app\Models\NewsCategory::where('is_active', true)->get() as $cat)
                            <li class="mb-2 pb-2 border-bottom last-child-no-border">
                                <a href="/{{ $page->slug }}?category={{ $cat->slug }}" class="text-dark d-flex justify-content-between align-items-center">
                                    {{ $cat->name }}
                                    <span class="badge badge-light badge-pill px-2">{{ $cat->news()->count() }}</span>
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

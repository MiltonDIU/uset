@php
    $newsService = app(\Modules\News\app\Services\NewsService::class);
    $count = (int) ($content['count'] ?? 6);
    $showFilter = $content['show_category_filter'] ?? true;
    $showPagination = $content['show_pagination'] ?? true;

    $newsQuery = \Modules\News\app\Models\News::query()
        ->where('status', 'published')
        ->latest('news_date');

    if (request()->filled('news_category')) {
        $newsQuery->whereHas('category', fn($q) => $q->where('slug', request('news_category')));
    }

    $newsList = $showPagination ? $newsQuery->paginate($count) : $newsQuery->limit($count)->get();
    $categories = $showFilter ? \Modules\News\app\Models\NewsCategory::where('is_active', true)->get() : collect();
@endphp

<section class="py-5 bg-light" id="news-section">
    <div class="container">
        @if(!empty($content['title']))
            <h2 class="section-heading text-center">{{ $content['title'] }}</h2>
        @else
            <h2 class="section-heading text-center">Recent News</h2>
        @endif

        {{-- Category Filters --}}
        @if($showFilter && $categories->count() > 0)
        <div class="d-flex justify-content-center mb-5 flex-wrap">
            <a href="{{ request()->url() }}#news-section" class="filter-btn {{ !request('news_category') ? 'active' : '' }}">
                All News
            </a>
            @foreach($categories as $cat)
                <a href="{{ request()->fullUrlWithQuery(['news_category' => $cat->slug]) }}#news-section"
                   class="filter-btn {{ request('news_category') === $cat->slug ? 'active' : '' }}">
                    {{ $cat->name }}
                </a>
            @endforeach
        </div>
        @endif

        <div class="row">
            @forelse($newsList as $news)
            <div class="col-lg-4 mb-4 ne-animate-item">
                <div class="card h-100 fade-in-up">
                    @if($news->getFirstMediaUrl('featured_image'))
                        <img src="{{ $news->getFirstMediaUrl('featured_image') }}" class="card-img-top" alt="{{ $news->title }}" style="height: 200px; object-fit: cover;">
                    @else
                        <div class="bg-secondary d-flex align-items-center justify-content-center" style="height: 200px;">
                            <i class="fas fa-newspaper fa-3x text-white-50"></i>
                        </div>
                    @endif
                    <div class="card-body">
                        @if($news->category)
                            <span class="badge badge-success mb-2">{{ $news->category->name }}</span>
                        @endif
                        <h5 class="card-title">{{ Str::limit($news->title, 60) }}</h5>
                        <div class="news-date mb-3">
                            <i class="fas fa-calendar-alt mr-2"></i> {{ $news->news_date?->format('M d, Y') }}
                        </div>
                        <p class="card-text">
                            {{ Str::limit($news->short_description ?? strip_tags($news->content), 120) }}
                        </p>
                        <a href="/news/{{ $news->slug }}" class="text-success font-weight-bold">Read More...</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">No news updates found.</p>
            </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($showPagination && $newsList instanceof \Illuminate\Pagination\LengthAwarePaginator && $newsList->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $newsList->appends(request()->query())->fragment('news-section')->links() }}
        </div>
        @endif
    </div>
</section>

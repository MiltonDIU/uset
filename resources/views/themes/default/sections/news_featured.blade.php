@php
    $newsService = app(\Modules\News\app\Services\NewsService::class);
    $count = (int) ($content['count'] ?? 1);
    $featuredNews = $newsService->getFeaturedNews($count);
    $showNewsletter = $content['show_newsletter'] ?? true;
    
    // Find the page that acts as the news listing to use its slug for details routing
    $newsPage = \Modules\CMS\app\Models\Page::whereIn('template', ['news_listing', 'news_events'])->where('is_published', true)->first();
    $newsRouteSlug = $newsPage ? $newsPage->slug : 'news';
@endphp

<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="{{ $showNewsletter ? 'col-lg-8' : 'col-12' }} mb-4">
                @forelse($featuredNews as $news)
                <div class="card featured-news fade-in-up ne-animate-item">
                    <div class="card-body p-4">
                        <span class="highlight-badge"><i class="fas fa-star mr-2"></i>Featured News</span>
                        <h3 class="card-title display-5 mt-3 font-weight-bold">
                            {{ $news->title }}
                        </h3>
                        @if($news->getFirstMediaUrl('featured_image'))
                            <img src="{{ $news->getFirstMediaUrl('featured_image') }}" alt="{{ $news->title }}" class="mb-3 rounded" style="width: 100%; max-height: 400px; object-fit: cover;">
                        @endif
                        <div class="news-date">
                            <i class="fas fa-calendar-alt mr-2"></i> {{ $news->news_date?->format('F d, Y') }}
                        </div>
                        <p class="card-text lead mb-4">
                            {{ Str::limit($news->short_description ?? strip_tags($news->content), 350) }}
                        </p>
                        <div class="d-flex flex-wrap">
                            <a href="/{{ $newsRouteSlug }}/{{ $news->slug }}" class="btn btn-success mr-3 mb-2">
                                <i class="fas fa-book-open mr-2"></i>Read Full Story
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="card featured-news fade-in-up ne-animate-item">
                    <div class="card-body p-4 text-center text-muted">
                        <i class="fas fa-newspaper fa-3x mb-3"></i>
                        <p>No featured news available at the moment.</p>
                    </div>
                </div>
                @endforelse
            </div>

            @if($showNewsletter)
            <div class="col-lg-4 mb-4">
                <div class="card newsletter-section text-center fade-in-up ne-animate-item" style="animation-delay: 0.2s">
                    <div class="card-body p-4">
                        <div class="news-icon"><i class="fas fa-bell"></i></div>
                        <h5 class="font-weight-bold mb-3">Stay Updated</h5>
                        <p class="mb-4">
                            Get the latest news, events, and announcements delivered to your inbox.
                        </p>
                        <form onsubmit="event.preventDefault(); alert('Subscribed!'); this.reset();">
                            <div class="form-group">
                                <input type="email" class="form-control mb-3" placeholder="Enter your email address" required />
                                <button type="submit" class="btn btn-light btn-block">
                                    <i class="fas fa-paper-plane mr-2"></i>Subscribe Now
                                </button>
                            </div>
                        </form>
                        <small>Join 2,500+ subscribers</small>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>

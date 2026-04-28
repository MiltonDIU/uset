<a href="/{{ $parentSlug ?? 'news' }}/{{ $news->slug }}" class="ne-featured-card">
    <div class="ne-featured-img">
        @if($news->getFirstMediaUrl('featured_image'))
            <img src="{{ $news->getFirstMediaUrl('featured_image') }}" alt="{{ $news->title }}" loading="lazy" />
        @else
            <div class="ne-placeholder"><i class="fas fa-newspaper fa-3x"></i></div>
        @endif
        <div class="ne-featured-overlay"></div>
    </div>
    <div class="ne-featured-body">
        <div class="ne-meta-row">
            <span class="ne-badge-featured"><i class="fas fa-star mr-1"></i> Featured</span>
            @if($news->category)
                <span class="ne-badge-cat">{{ $news->category->name }}</span>
            @endif
        </div>
        <h3 class="ne-featured-title">{{ $news->title }}</h3>
        <p class="ne-featured-excerpt">{{ Str::limit($news->short_description ?? strip_tags($news->content), 180) }}</p>
        <div class="ne-featured-foot">
            <span><i class="far fa-calendar mr-1"></i> {{ $news->news_date?->format('M d, Y') }}</span>
            <span class="ne-read-more">Read Full Story <i class="fas fa-arrow-right ml-1"></i></span>
        </div>
    </div>
</a>

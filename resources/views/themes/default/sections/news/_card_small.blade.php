<a href="/{{ $parentSlug ?? 'news' }}/{{ $news->slug }}" class="ne-card">
    <div class="ne-card-img">
        @if($news->getFirstMediaUrl('featured_image'))
            <img src="{{ $news->getFirstMediaUrl('featured_image') }}" alt="{{ $news->title }}" loading="lazy" />
        @else
            <div class="ne-card-icon"><i class="fas fa-newspaper"></i></div>
        @endif
        @if($news->is_pinned)
            <span class="ne-pin"><i class="fas fa-thumbtack"></i></span>
        @endif
    </div>
    <div class="ne-card-body">
        @if($news->category)
            <span class="ne-tag">{{ $news->category->name }}</span>
        @endif
        <h5 class="ne-card-title">{{ Str::limit($news->title, 70) }}</h5>
        <p class="ne-card-text">{{ Str::limit($news->short_description ?? strip_tags($news->content), 100) }}</p>
        <div class="ne-card-foot">
            <span class="ne-date"><i class="far fa-calendar mr-1"></i> {{ $news->news_date?->format('M d, Y') }}</span>
            <span class="ne-link">Read More <i class="fas fa-arrow-right"></i></span>
        </div>
    </div>
</a>

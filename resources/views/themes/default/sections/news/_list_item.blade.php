<a href="/{{ $parentSlug ?? 'news' }}/{{ $news->slug }}" class="ne-list-item">
    <div class="ne-list-thumb">
        @if($news->getFirstMediaUrl('featured_image'))
            <img src="{{ $news->getFirstMediaUrl('featured_image') }}" alt="{{ $news->title }}" loading="lazy" />
        @else
            <div class="ne-card-icon"><i class="fas fa-newspaper"></i></div>
        @endif
    </div>
    <div class="ne-list-body">
        <div class="ne-list-meta">
            @if($news->category)<span class="ne-tag">{{ $news->category->name }}</span>@endif
            <span class="ne-date"><i class="far fa-calendar mr-1"></i> {{ $news->news_date?->format('M d, Y') }}</span>
        </div>
        <h5>{{ $news->title }}</h5>
        <p>{{ Str::limit($news->short_description ?? strip_tags($news->content), 150) }}</p>
    </div>
    <div class="ne-list-arrow"><i class="fas fa-chevron-right"></i></div>
</a>

<a href="/{{ $parentSlug ?? 'news' }}/{{ $news->slug }}" class="ne-side-card">
    <div class="row no-gutters">
        <div class="col-md-6">
            <div class="ne-side-img">
                @if($news->getFirstMediaUrl('featured_image'))
                    <img src="{{ $news->getFirstMediaUrl('featured_image') }}" alt="{{ $news->title }}" />
                @else
                    <div class="ne-placeholder"><i class="fas fa-newspaper fa-3x"></i></div>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="ne-side-body">
                <div class="ne-meta-row">
                    <span class="ne-badge-featured"><i class="fas fa-star mr-1"></i> Featured</span>
                    @if($news->category)<span class="ne-badge-cat">{{ $news->category->name }}</span>@endif
                </div>
                <h3>{{ $news->title }}</h3>
                <p>{{ Str::limit($news->short_description ?? strip_tags($news->content), 200) }}</p>
                <div class="ne-featured-foot">
                    <span><i class="far fa-calendar mr-1"></i> {{ $news->news_date?->format('M d, Y') }}</span>
                    <span class="ne-read-more">Read More <i class="fas fa-arrow-right ml-1"></i></span>
                </div>
            </div>
        </div>
    </div>
</a>

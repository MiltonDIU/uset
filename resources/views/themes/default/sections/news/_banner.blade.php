<a href="/{{ $parentSlug ?? 'news' }}/{{ $news->slug }}" class="ne-banner-card" style="background-image: url('{{ $news->getFirstMediaUrl('featured_image') ?: theme_asset('img/placeholder.jpg') }}')">
    <div class="ne-banner-overlay"></div>
    <div class="ne-banner-content">
        <div class="ne-meta-row">
            <span class="ne-badge-featured"><i class="fas fa-star mr-1"></i> Featured</span>
            @if($news->category)
                <span class="ne-badge-cat">{{ $news->category->name }}</span>
            @endif
        </div>
        <h2>{{ $news->title }}</h2>
        <p>{{ Str::limit($news->short_description ?? strip_tags($news->content), 150) }}</p>
        <span class="ne-read-more">Read Full Story <i class="fas fa-arrow-right ml-1"></i></span>
    </div>
</a>

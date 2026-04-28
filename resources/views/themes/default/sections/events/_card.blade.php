<a href="/{{ $parentSlug ?? 'events' }}/{{ $event->slug }}" class="ne-card">
    <div class="ne-card-img">
        @if($event->getFirstMediaUrl('banner'))
            <img src="{{ $event->getFirstMediaUrl('banner') }}" alt="{{ $event->title }}" loading="lazy" />
        @else
            <div class="ne-card-icon"><i class="fas fa-calendar-alt"></i></div>
        @endif
        <div class="ne-card-date-overlay">
            <span class="day">{{ $event->event_date->format('d') }}</span>
            <span class="month">{{ $event->event_date->format('M') }}</span>
        </div>
    </div>
    <div class="ne-card-body">
        @if($event->category)<span class="ne-tag">{{ $event->category->name }}</span>@endif
        <span class="ne-status ne-status-{{ strtolower($event->auto_status) }}">{{ $event->auto_status }}</span>
        <h5 class="ne-card-title">{{ Str::limit($event->title, 60) }}</h5>
        <div class="ne-card-foot">
            @if($event->venue)<span><i class="fas fa-map-marker-alt mr-1"></i> {{ Str::limit($event->venue, 25) }}</span>@endif
            <span class="ne-link">Details <i class="fas fa-arrow-right"></i></span>
        </div>
    </div>
</a>

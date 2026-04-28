<a href="/{{ $parentSlug ?? 'events' }}/{{ $event->slug }}" class="ne-event-timeline">
    <div class="ne-event-date-box">
        <span class="ne-day">{{ $event->event_date->format('d') }}</span>
        <span class="ne-month">{{ $event->event_date->format('M') }}</span>
    </div>
    <div class="ne-event-info">
        <div class="ne-event-meta-row">
            @if($event->category)<span class="ne-tag">{{ $event->category->name }}</span>@endif
            <span class="ne-status ne-status-{{ strtolower($event->auto_status) }}">{{ $event->auto_status }}</span>
        </div>
        <h5 class="ne-event-title">{{ $event->title }}</h5>
        <div class="ne-event-details">
            @if($event->start_time)
                <span><i class="far fa-clock mr-1"></i> {{ \Carbon\Carbon::parse($event->start_time)->format('h:i A') }}</span>
            @endif
            @if($event->venue)
                <span><i class="fas fa-map-marker-alt mr-1"></i> {{ $event->venue }}</span>
            @endif
        </div>
    </div>
    @if($event->getFirstMediaUrl('banner'))
    <div class="ne-event-thumb">
        <img src="{{ $event->getFirstMediaUrl('banner') }}" alt="{{ $event->title }}" loading="lazy" />
    </div>
    @endif
</a>

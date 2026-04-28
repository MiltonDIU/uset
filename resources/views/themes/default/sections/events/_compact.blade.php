<a href="/{{ $parentSlug ?? 'events' }}/{{ $event->slug }}" class="ne-compact-item">
    <div class="ne-compact-date">
        <span class="day">{{ $event->event_date->format('d') }}</span>
        <span class="month">{{ $event->event_date->format('M') }}</span>
    </div>
    <div class="ne-compact-body">
        <h6>{{ Str::limit($event->title, 50) }}</h6>
        @if($event->venue)<small class="text-muted"><i class="fas fa-map-marker-alt mr-1"></i>{{ $event->venue }}</small>@endif
    </div>
    <span class="ne-status ne-status-{{ strtolower($event->auto_status) }}">{{ $event->auto_status }}</span>
</a>

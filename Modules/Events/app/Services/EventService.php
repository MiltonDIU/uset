<?php

namespace Modules\Events\app\Services;

use Modules\Events\app\Models\Event;
use Illuminate\Support\Collection;

class EventService
{
    public function getUpcomingEvents(int $limit = 5): Collection
    {
        return Event::query()
            ->where('is_published', true)
            ->where('event_date', '>=', now()->startOfDay())
            ->where('status', '!=', 'Cancelled')
            ->orderBy('event_date', 'asc')
            ->limit($limit)
            ->get();
    }

    public function getRecentEvents(int $limit = 5): Collection
    {
        return Event::query()
            ->where('is_published', true)
            ->where('event_date', '<', now()->startOfDay())
            ->latest('event_date')
            ->limit($limit)
            ->get();
    }

    public function getFeaturedEvents(int $limit = 3): Collection
    {
        return Event::query()
            ->where('is_published', true)
            ->where('is_featured', true)
            ->orderBy('event_date', 'asc')
            ->limit($limit)
            ->get();
    }

    public function getEventsForCalendar(int $year, int $month): Collection
    {
        return Event::query()
            ->where('is_published', true)
            ->whereYear('event_date', $year)
            ->whereMonth('event_date', $month)
            ->get();
    }
}

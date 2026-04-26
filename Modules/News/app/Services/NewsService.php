<?php

namespace Modules\News\app\Services;

use Modules\News\app\Models\News;
use Illuminate\Support\Collection;

class NewsService
{
    public function getLatestNews(int $limit = 5): Collection
    {
        return News::query()
            ->where('status', 'published')
            ->latest('news_date')
            ->limit($limit)
            ->get();
    }

    public function getFeaturedNews(int $limit = 3): Collection
    {
        return News::query()
            ->where('status', 'published')
            ->where('is_featured', true)
            ->latest('news_date')
            ->limit($limit)
            ->get();
    }

    public function getPinnedNews(): Collection
    {
        return News::query()
            ->where('status', 'published')
            ->where('is_pinned', true)
            ->latest('news_date')
            ->get();
    }

    public function getBreakingNews(): ?News
    {
        return News::query()
            ->where('status', 'published')
            ->where('is_breaking', true)
            ->latest('news_date')
            ->first();
    }
}

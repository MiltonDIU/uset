<?php

use App\Http\Controllers\Frontend\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'index'])->name('home');

// Test Routes for Premium Designs
Route::get('/test/news-events', function() {
    return theme_view('pages.news-events-premium');
});
Route::get('/test/news-detail', function() {
    $news = \Modules\News\app\Models\News::where('status', 'published')->first();
    if (!$news) return "No published news found in database.";
    return theme_view('pages.news-detail-premium', compact('news'));
});
Route::get('/test/event-detail', function() {
    $event = \Modules\Events\app\Models\Event::where('is_published', true)->first();
    if (!$event) return "No published events found in database.";
    return theme_view('pages.event-detail-premium', compact('event'));
});

Route::get('/{slug}/{detail?}', [PageController::class, 'show'])->name('page.show');

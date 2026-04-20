<section class="news-events-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge badge-success px-3 py-2 mb-3">{{ $content['badge'] ?? 'Stay Updated' }}</span>
            <h2 class="section-title h1 mb-3">{{ $content['title'] ?? 'Latest News & Events' }}</h2>
            <p class="lead text-muted mb-0 mx-auto" style="max-width: 700px">
                {{ $content['description'] ?? '' }}
            </p>
        </div>

        <div class="row">
            <!-- News Column -->
            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="section-header d-flex justify-content-between align-items-center mb-4">
                    <h3 class="h4 mb-0">Recent News</h3>
                    <a href="#" class="text-success">View All News</a>
                </div>
                <div id="recent-news">
                    <!-- News items will be loaded here via JavaScript -->
                </div>
            </div>

            <!-- Events Column -->
            <div class="col-lg-6">
                <div class="section-header d-flex justify-content-between align-items-center mb-4">
                    <h3 class="h4 mb-0">Upcoming Events</h3>
                    <a href="#" class="text-success">View All Events</a>
                </div>
                <div id="upcoming-events">
                    <!-- Event items will be loaded here via JavaScript -->
                </div>
            </div>
        </div>
    </div>
</section>

<section class="featured-programs-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge badge-success px-3 py-2 mb-3">{{ $content['badge'] ?? 'Our Programs' }}</span>
            <h2 class="section-title h1 mb-3">{{ $content['title'] ?? 'Featured Academic Programs' }}</h2>
            <p class="lead text-muted mb-0 mx-auto" style="max-width: 700px">
                {{ $content['description'] ?? '' }}
            </p>
        </div>

        <div class="row" id="featured-programs">
            <!-- Programs will be loaded dynamically via JavaScript or can be rendered here if models are available -->
        </div>

        <div class="text-center mt-5">
            <a href="{{ $content['button_url'] ?? '#' }}" class="btn btn-outline-success btn-lg">
                {{ $content['button_text'] ?? 'Explore All Programs' }}
                <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</section>

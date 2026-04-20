<section class="cta-section">
    <div class="container">
        <div class="cta-wrapper text-center">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <span class="badge badge-light px-3 py-2 mb-4">{{ $content['badge'] ?? 'Join USET' }}</span>
                    <h2 class="h1 text-white mb-4">
                        {{ $content['title'] ?? 'Ready to Start Your Educational Journey?' }}
                    </h2>
                    <p class="lead text-white-75 mb-5">
                        {{ $content['description'] ?? '' }}
                    </p>
                    <div class="cta-buttons d-flex justify-content-center flex-wrap">
                        @if(!empty($content['primary_button_text']))
                            <a href="{{ $content['primary_button_url'] ?? '#' }}" class="btn btn-light btn-lg text-success mr-3 mb-3">
                                <i class="fas fa-paper-plane mr-2"></i>
                                {{ $content['primary_button_text'] }}
                            </a>
                        @endif
                        @if(!empty($content['secondary_button_text']))
                            <a href="{{ $content['secondary_button_url'] ?? '#' }}" class="btn btn-outline-light btn-lg mb-3">
                                <i class="fas fa-envelope mr-2"></i>
                                {{ $content['secondary_button_text'] }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="why-choose-section">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge badge-success px-3 py-2 mb-3">{{ $content['badge'] ?? 'Why USET?' }}</span>
            <h2 class="section-title h1 mb-3">{{ $content['title'] ?? 'What Makes Us Different' }}</h2>
            <p class="lead text-muted mb-0 mx-auto" style="max-width: 700px">
                {{ $content['description'] ?? '' }}
            </p>
        </div>

        <div class="row" id="value-propositions">
            @foreach($content['items'] ?? [] as $item)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card value-proposition h-100">
                        <div class="card-body">
                            <div class="value-icon mb-3">
                                @switch($item['icon'] ?? 'academic-cap')
                                    @case('academic-cap') <i class="fas fa-graduation-cap fa-lg"></i> @break
                                    @case('map') <i class="fas fa-map-marked-alt fa-lg"></i> @break
                                    @case('briefcase') <i class="fas fa-briefcase fa-lg"></i> @break
                                    @case('flag') <i class="fas fa-flag fa-lg"></i> @break
                                    @case('globe-alt') <i class="fas fa-globe-asia fa-lg"></i> @break
                                    @default <i class="fas fa-university fa-lg"></i>
                                @endswitch
                            </div>
                            <h3 class="h5 font-weight-bold mb-3">{{ $item['title'] }}</h3>
                            <p class="text-muted mb-0">{{ $item['description'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if(!empty($content['button_text']))
            <div class="text-center mt-5">
                <a href="{{ $content['button_url'] ?? '#' }}" class="btn btn-outline-success btn-lg">
                    {{ $content['button_text'] }}
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        @endif
    </div>
</section>

<section class="py-5 bg-white">
    <div class="container">
        @if(!empty($content['title']))
            <h2 class="section-heading text-center mb-5">{{ $content['title'] }}</h2>
        @endif
        <div class="row text-center">
            @foreach($content['items'] ?? [] as $item)
                <div class="col-md-3 col-6 mb-4">
                    <div class="stats-item fade-in-up ne-animate-item">
                        <div class="stats-number display-4 font-weight-bold">
                            {{ $item['value'] }}
                        </div>
                        <div class="stats-label text-muted">
                            {{ $item['label'] }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

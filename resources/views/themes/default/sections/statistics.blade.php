<section class="py-5 stats-section bg-primary-700">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="h1 mb-3 text-white">{{ $content['title'] ?? 'USET By The Numbers' }}</h2>
            <p class="lead mb-0 text-white">{{ $content['subtitle'] ?? '' }}</p>
        </div>

        <div class="row">
            @foreach($content['items'] ?? [] as $item)
                <div class="col-6 col-md-3 mb-4">
                    <div class="stat-item text-center">
                        <div class="stat-value text-white" data-target="{{ $item['value'] }}">0</div>
                        <div class="stat-label text-white">{{ $item['label'] }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

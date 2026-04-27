<div class="timeline">
    @foreach($data['timeline_items'] ?? [] as $item)
        <div class="timeline-item">
            <div class="timeline-content">
                <div class="milestone-header d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="milestone-icon">
                            <i class="{{ $item['icon'] ?? 'fas fa-lightbulb' }}"></i>
                        </div>
                        <h3 class="mb-0 ml-3">{{ $item['title'] ?? '' }}</h3>
                    </div>
                    <div class="year">{{ $item['year'] ?? '' }}</div>
                </div>
                <p>{{ $item['description'] ?? '' }}</p>
            </div>
        </div>
    @endforeach
</div>

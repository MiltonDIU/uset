<div class="row">
    @foreach($data['facility_items'] ?? [] as $item)
        <div class="col-md-4 mb-4">
            <div class="facility-card">
                <div class="facility-icon">
                    <i class="{{ $item['icon'] ?? 'fas fa-laptop-code' }}"></i>
                </div>
                <h3>{{ $item['title'] ?? '' }}</h3>
                <p>{{ $item['description'] ?? '' }}</p>
            </div>
        </div>
    @endforeach
</div>

<div class="row">
    @foreach($data['leader_items'] ?? [] as $item)
        <div class="col-md-4 mb-4">
            <div class="leader-card">
                <div class="leader-image">
                    @if(!empty($item['image']))
                        <img src="{{ Storage::url($item['image']) }}" alt="{{ $item['name'] ?? '' }}" class="img-fluid" />
                    @else
                        <img src="{{ theme_asset('img/placeholder-user.jpg') }}" alt="Placeholder" class="img-fluid" />
                    @endif
                </div>
                <div class="leader-info">
                    <div class="leader-role">{{ $item['role'] ?? '' }}</div>
                    <h3>{{ $item['name'] ?? '' }}</h3>
                    <p class="leader-education">{{ $item['education'] ?? '' }}</p>
                    <p class="description">{{ $item['description'] ?? '' }}</p>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="row">
    <div class="col-md-6">
        <div class="location-info">
            <h2>{{ $data['location_title'] ?? 'Visit USET' }}</h2>
            
            <div class="address-box mb-4">
                <h3>Address</h3>
                <p>{!! nl2br(e($data['address'] ?? '')) !!}</p>
            </div>

            <div class="contact-box mb-4">
                <h3>Contact Information</h3>
                @if(!empty($data['phone']))
                    <p><i class="fas fa-phone-alt mr-2"></i> {{ $data['phone'] }}</p>
                @endif
                @if(!empty($data['email']))
                    <p><i class="fas fa-envelope mr-2"></i> {{ $data['email'] }}</p>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-6">
        @if(!empty($data['map_iframe_url']))
            <div class="map-container">
                <iframe src="{{ $data['map_iframe_url'] }}" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        @endif
    </div>
</div>

@php
    $badge = $content['badge'] ?? 'Visit Us';
    $title = $content['title'] ?? 'Our Location';
    $subtitle = $content['subtitle'] ?? '';
    $address = $content['address'] ?? '';
    $phone = $content['phone'] ?? '';
    $email = $content['email'] ?? '';
    $timing = $content['timing'] ?? '';
    $googleMapsUrl = $content['google_maps_url'] ?? 'https://maps.google.com';
    $googleMapsEmbedUrl = $content['google_maps_embed_url'] ?? '';
    $contactPageLink = $content['contact_page_link'] ?? '/contact';
@endphp

<section class="location-section">
    <div class="container">
        <div class="section-header text-center mb-5">
            @if($badge)
                <span class="badge badge-success px-3 py-2 mb-2">{{ $badge }}</span>
            @endif
            <h2 class="h1 mb-4">{{ $title }}</h2>
            @if($subtitle)
                <p class="lead mb-0 mx-auto" style="max-width: 600px">
                    {{ $subtitle }}
                </p>
            @endif
        </div>

        <div class="location-container">
            <div class="row g-0">
                <div class="col-lg-5">
                    <div class="location-info-wrapper">
                        <div class="info-card">
                            <div class="info-card-header">
                                <div class="info-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <h3 class="info-title">Campus Address</h3>
                            </div>
                            <p>{!! nl2br(e($address)) !!}</p>
                        </div>

                        <div class="info-card">
                            <div class="info-card-header">
                                <div class="info-icon">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                                <h3 class="info-title">Contact Details</h3>
                            </div>
                            <ul class="contact-list">
                                @if($phone)
                                    <li class="contact-item">
                                        <i class="fas fa-phone"></i>
                                        <span>{{ $phone }}</span>
                                    </li>
                                @endif
                                @if($email)
                                    <li class="contact-item">
                                        <i class="fas fa-envelope"></i>
                                        <span>{{ $email }}</span>
                                    </li>
                                @endif
                                @if($timing)
                                    <li class="contact-item">
                                        <i class="fas fa-clock"></i>
                                        <span>{{ $timing }}</span>
                                    </li>
                                @endif
                            </ul>
                        </div>

                        <div class="direction-buttons">
                            @if($googleMapsUrl)
                                <a href="{{ $googleMapsUrl }}" target="_blank" class="direction-btn btn-primary">
                                    <i class="fas fa-directions mr-2"></i>
                                    Get Directions
                                </a>
                            @endif
                            <a href="{{ url($contactPageLink) }}" class="direction-btn btn-outline">
                                <i class="fas fa-envelope mr-2"></i>
                                Contact Us
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="map-container">
                        @if($googleMapsEmbedUrl)
                            <iframe
                                src="{{ $googleMapsEmbedUrl }}"
                                width="100%" height="450" style="border: 0" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


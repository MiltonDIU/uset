@php
    $badge = $content['badge'] ?? 'Our Team';
    $title = $content['title'] ?? 'Our Leadership';
    $subtitle = $content['subtitle'] ?? '';
    $members = $content['members'] ?? [];
@endphp

<!-- Leadership Section -->
<section class="leadership-section py-5 bg-light">
    <div class="container">
        <div class="section-header text-center mb-5">
            @if($badge)
                <span class="badge badge-success px-3 py-2 mb-2">{{ $badge }}</span>
            @endif
            <h2 class="h1 mb-4">{{ $title }}</h2>
            @if($subtitle)
                <p class="lead mb-0 mx-auto" style="max-width: 800px">
                    {{ $subtitle }}
                </p>
            @endif
        </div>

        <div class="row justify-content-center">
            @foreach($members as $member)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="leader-card">
                        <div class="leader-image">
                            <img src="{{ !empty($member['image']) ? Storage::url($member['image']) : theme_asset('img/placeholder-user.jpg') }}" alt="{{ $member['name'] }}" />
                            <div class="social-links">
                                @if(!empty($member['linkedin_url']))
                                    <a href="{{ $member['linkedin_url'] }}" target="_blank" class="social-link"><i class="fab fa-linkedin"></i></a>
                                @endif
                                @if(!empty($member['twitter_url']))
                                    <a href="{{ $member['twitter_url'] }}" target="_blank" class="social-link"><i class="fab fa-twitter"></i></a>
                                @endif
                            </div>
                        </div>
                        <div class="leader-info">
                            <div class="leader-role">{{ $member['role'] }}</div>
                            <h3>
                                @if(!empty($member['link']))
                                    <a href="{{ $member['link'] }}" class="text-decoration-none" style="color: #000">{{ $member['name'] }}</a>
                                @endif
                                @if(empty($member['link']))
                                    {{ $member['name'] }}
                                @endif
                            </h3>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>


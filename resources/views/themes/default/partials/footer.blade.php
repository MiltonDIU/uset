<footer class="footer py-5">
    <div class="container">
        <div class="row">
            @php
                $columns = $activeTheme->settings['footer_columns'] ?? [];
            @endphp

            @foreach($columns as $column)
                @php
                    $bootstrapCol = $column['width'] ?? 'col-lg-3';
                    $widgets = $column['widgets'] ?? [];
                @endphp

                <div class="{{ $bootstrapCol }} col-md-6 mb-5 mb-lg-0">
                    @foreach($widgets as $widget)
                        <div class="footer-widget mb-4">
                            @if($widget['type'] === 'about')
                                <div class="footer-brand mb-4">
                                    @php
                                        $footerLogo = $activeTheme->getFirstMediaUrl('footer_logo');
                                    @endphp
                                    <img src="{{ $footerLogo ?: theme_asset('img/LOGO.png') }}" alt="USET Logo" class="footer-logo mb-3" />
                                    <h5 class="text-white mb-3">
                                        {{ $activeTheme->settings['footer_university_name'] ?? '' }}
                                    </h5>
                                </div>
                                <p class="text-white-50 mb-4">
                                    {{ $widget['description'] ?? '' }}
                                </p>

                            @elseif($widget['type'] === 'menu')
                                <h5 class="text-white mb-4">{{ $widget['title'] ?? '' }}</h5>
                                <x-filament-menu-builder::menu :slug="$widget['menu_slug'] ?? ''" view="themes.default.partials.footer-menu" />

                            @elseif($widget['type'] === 'contact')
                                <h5 class="text-white mb-4">{{ $widget['title'] ?? '' }}</h5>
                                <ul class="contact-info list-unstyled">
                                    @if(!empty($widget['address']))
                                        <li class="d-flex mb-3">
                                            <i class="fas fa-map-marker-alt contact-icon"></i>
                                            <span class="text-white-50">{{ $widget['address'] }}</span>
                                        </li>
                                    @endif
                                    @if(!empty($widget['phone']))
                                        <li class="d-flex mb-3">
                                            <i class="fas fa-phone contact-icon"></i>
                                            <a href="tel:{{ str_replace([' ', '-', '(', ')'], '', $widget['phone']) }}" class="text-white-50">{{ $widget['phone'] }}</a>
                                        </li>
                                    @endif
                                    @if(!empty($widget['email']))
                                        <li class="d-flex mb-3">
                                            <i class="fas fa-envelope contact-icon"></i>
                                            <a href="mailto:{{ $widget['email'] }}" class="text-white-50">{{ $widget['email'] }}</a>
                                        </li>
                                    @endif
                                </ul>

                            @elseif($widget['type'] === 'social')
                                <h5 class="text-white mb-4">{{ $widget['title'] ?? '' }}</h5>
                                <div class="social-icons">
                                    @php
                                        $socialService = app(\Modules\Social\app\Services\SocialService::class);
                                        $socialLinks = $socialService->getActiveLinks();
                                        $platformIcons = \Modules\Social\app\Models\SocialLink::getPlatformIcons();
                                    @endphp

                                    @foreach($socialLinks as $link)
                                        <a href="{{ $link->url }}" class="social-icon" target="_blank" aria-label="{{ ucfirst($link->platform) }}">
                                            <i class="{{ $link->icon ?: ($platformIcons[$link->platform] ?? 'fas fa-link') }}"></i>
                                        </a>
                                    @endforeach
                                </div>

                            @elseif($widget['type'] === 'text')
                                <h5 class="text-white mb-4">{{ $widget['title'] ?? '' }}</h5>
                                <div class="text-white-50">
                                    {!! nl2br(e($widget['content'] ?? '')) !!}
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>

    <!-- Copyright -->
    <div class="footer-bottom">
        <div class="container">
            <hr class="footer-divider" />
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-left">
                    <p class="copyright mb-0">
                        {{ $activeTheme->settings['footer_copyright'] ?? '© ' . date('Y') . ' University of Skill Enrichment & Technology. All Rights Reserved.' }}
                    </p>
                </div>
                <div class="col-md-6 text-center text-md-right">
                    <x-filament-menu-builder::menu :slug="$activeTheme->settings['footer_bottom_menu_slug'] ?? 'footer-bottom'" view="themes.default.partials.footer-bottom-menu" />
                </div>
            </div>
        </div>
    </div>
</footer>

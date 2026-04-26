<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                @php
                    $activeTheme = app(\Modules\Theme\app\Services\ThemeService::class)->current();
                    $logo = $activeTheme->getFirstMediaUrl('main_logo');
                @endphp
                <img src="{{ $logo ?: theme_asset('img/LOGO.png') }}" alt="USET Logo" class="mr-2" style="max-height: 50px; width: auto;" />
                <div class="d-none d-md-block">
                    <!-- <small class="text-muted university-slogan">Bangladesh's First Skill-Based University</small> -->
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <x-filament-menu-builder::menu slug="main-menu" view="themes.default.partials.main-menu" />
                
                <a href="#" class="btn btn-success d-none d-md-block">Apply Now</a>
            </div>
        </div>
    </nav>
</header>

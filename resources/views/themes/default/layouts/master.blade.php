<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description"
        content="@yield('meta_description', 'USET - University of Skill Enrichment & Technology is Bangladesh\'s first skill-based university, committed to providing industry-relevant education.')" />
    <title>@yield('title', 'USET - University of Skill Enrichment & Technology')</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ theme_asset('img/LOGO.png') }}" type="image/x-icon" />

    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet" />

    <!-- Slick Carousel -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ theme_asset('css/styles.css') }}" />
    
    @stack('styles')
</head>

<body>
    <!-- Header/Navigation -->
    @include(app(\Modules\Theme\app\Services\ThemeService::class)->view('partials.header'))

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @include(app(\Modules\Theme\app\Services\ThemeService::class)->view('partials.footer'))

    <!-- Back to Top Button -->
    <button id="backToTop" class="back-to-top" aria-label="Back to top">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Slick Carousel -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

    <!-- Custom JS -->
    <script src="{{ theme_asset('js/main.js') }}"></script>
    <script src="{{ theme_asset('js/header.js') }}"></script>
    
    @stack('scripts')
</body>

</html>

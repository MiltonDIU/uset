<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'স্কলার্স ইউনিভার্সিটি')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Lucide Icons CDN -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Alpine.js for Interactivity -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1e3a8a',    // Blue-900
                        secondary: '#eab308',  // Yellow-500
                        accent: '#2563eb',     // Blue-600
                        surface: '#f8fafc',    // Slate-50
                    },
                    fontFamily: {
                        sans: ['Inter', 'Hind Siliguri', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        [x-cloak] { display: none !important; }
        html { scroll-behavior: smooth; }
        .hero-gradient {
            background: linear-gradient(to right, rgba(30, 58, 138, 0.8), rgba(30, 58, 138, 0.2));
        }
    </style>
    @stack('styles')
</head>
<body class="font-sans antialiased text-slate-800 bg-surface" x-data="{ scrolled: false, isMenuOpen: false, activeSubmenu: null }" @scroll.window="scrolled = (window.pageYOffset > 50)">

@include(app(Modules\Theme\app\Services\ThemeService::class)->view('partials.header'))

<main>
    @yield('content')
</main>

@include(app(Modules\Theme\app\Services\ThemeService::class)->view('partials.footer'))

<!-- Scroll Top -->
<button
    x-show="scrolled"
    x-transition
    @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
    class="fixed bottom-8 right-8 bg-accent p-3 rounded-md shadow-lg text-white transform hover:scale-110 active:scale-95 transition-all"
    x-cloak
>
    <i data-lucide="arrow-up" class="h-5 w-5"></i>
</button>

<script>
    // Initialize Lucide icons
    lucide.createIcons();
</script>
@stack('scripts')
</body>
</html>

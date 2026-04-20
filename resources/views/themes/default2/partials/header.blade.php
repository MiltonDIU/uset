<!-- Navigation -->
<nav
    :class="scrolled ? 'bg-primary shadow-md py-3' : 'bg-transparent py-5'"
    class="fixed w-full z-50 transition-all duration-300"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center">
                    <i data-lucide="graduation-cap" class="h-6 w-6 text-primary"></i>
                </div>
                <span class="text-xl font-bold tracking-tight uppercase text-white">
                    স্কলার্স ইউনিভার্সিটি
                </span>
            </a>

            <!-- Dynamic Desktop Nav -->
            <x-filament-menu-builder::menu slug="main-menu" view="themes.default2.partials.main-menu" />

            <!-- Mobile Nav Toggle -->
            <div class="md:hidden">
                <button @click="isMenuOpen = !isMenuOpen" class="p-2 rounded-md text-white outline-none">
                    <i x-show="!isMenuOpen" data-lucide="menu" class="h-6 w-6"></i>
                    <i x-show="isMenuOpen" data-lucide="x" class="h-6 w-6" x-cloak></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div
        x-show="isMenuOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-4"
        class="md:hidden bg-primary border-t border-white/10"
        x-cloak
    >
        <!-- Dynamic Mobile Nav -->
        <x-filament-menu-builder::menu slug="main-menu" view="themes.default2.partials.main-menu" :mobile="true" />
    </div>
</nav>

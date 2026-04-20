<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Modules\Theme\app\Models\Theme;
use App\Policies\ThemePolicy;
use Biostate\FilamentMenuBuilder\Models\Menu;
use App\Policies\MenuPolicy;
use Biostate\FilamentMenuBuilder\Models\MenuItem;
use App\Policies\MenuItemPolicy;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(Theme::class, ThemePolicy::class);
        Gate::policy(Menu::class, MenuPolicy::class);
        Gate::policy(MenuItem::class, MenuItemPolicy::class);
    }
}

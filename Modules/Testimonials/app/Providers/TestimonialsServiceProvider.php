<?php

namespace Modules\Testimonials\app\Providers;

use Nwidart\Modules\Support\ModuleServiceProvider;

class TestimonialsServiceProvider extends ModuleServiceProvider
{
    protected string $name = 'Testimonials';

    protected string $nameLower = 'testimonials';

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);
    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(module_path($this->name, 'database/migrations'));
    }
}

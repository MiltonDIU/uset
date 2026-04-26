<?php

namespace Modules\Events\app\Providers;

use Nwidart\Modules\Support\ModuleServiceProvider;

class EventsServiceProvider extends ModuleServiceProvider
{
    protected string $name = 'Events';

    protected string $nameLower = 'events';

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);
    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(module_path($this->name, 'database/migrations'));
    }
}

<?php

namespace Modules\Labs\app\Providers;

use Nwidart\Modules\Support\ModuleServiceProvider;

class LabsServiceProvider extends ModuleServiceProvider
{
    protected string $name = 'Labs';

    protected string $nameLower = 'labs';

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);
    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(module_path($this->name, 'database/migrations'));
    }
}

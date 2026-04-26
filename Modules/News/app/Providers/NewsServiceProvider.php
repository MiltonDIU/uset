<?php

namespace Modules\News\app\Providers;

use Nwidart\Modules\Support\ModuleServiceProvider;

class NewsServiceProvider extends ModuleServiceProvider
{
    protected string $name = 'News';

    protected string $nameLower = 'news';

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);
    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(module_path($this->name, 'database/migrations'));
    }
}

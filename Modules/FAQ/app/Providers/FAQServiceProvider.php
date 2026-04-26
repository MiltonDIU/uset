<?php

namespace Modules\FAQ\app\Providers;

use Nwidart\Modules\Support\ModuleServiceProvider;

class FAQServiceProvider extends ModuleServiceProvider
{
    protected string $name = 'FAQ';

    protected string $nameLower = 'faq';

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);
    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(module_path($this->name, 'database/migrations'));
    }
}

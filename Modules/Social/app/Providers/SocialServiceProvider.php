<?php

namespace Modules\Social\app\Providers;

use Nwidart\Modules\Support\ModuleServiceProvider;

class SocialServiceProvider extends ModuleServiceProvider
{
    protected string $name = 'Social';

    protected string $nameLower = 'social';

    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(module_path($this->name, 'database/migrations'));
    }
}

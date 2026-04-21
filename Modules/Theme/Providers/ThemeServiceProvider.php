<?php

namespace Modules\Theme\Providers;

use Illuminate\Console\Scheduling\Schedule;
use Modules\Theme\app\Services\ThemeService;
use Nwidart\Modules\Support\ModuleServiceProvider;

class ThemeServiceProvider extends ModuleServiceProvider
{
    /**
     * The name of the module.
     */
    protected string $name = 'Theme';

    /**
     * Register any application services.
     */
    public function register(): void
    {
        parent::register();
        $this->app->singleton(ThemeService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        parent::boot();
        $this->loadMigrationsFrom(module_path($this->name, 'Database/migrations'));
    }

    /**
     * The lowercase version of the module name.
     */
    protected string $nameLower = 'theme';

    /**
     * Command classes to register.
     *
     * @var string[]
     */
    // protected array $commands = [];

    /**
     * Provider classes to register.
     *
     * @var string[]
     */
    protected array $providers = [
        EventServiceProvider::class,
        RouteServiceProvider::class,
    ];

    /**
     * Define module schedules.
     *
     * @param  $schedule
     */
    // protected function configureSchedules(Schedule $schedule): void
    // {
    //     $schedule->command('inspire')->hourly();
    // }
}

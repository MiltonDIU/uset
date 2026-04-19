<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Navigation\NavigationItem;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Nwidart\Modules\Facades\Module;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        $panel = $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                AccountWidget::class,
                FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                PreventRequestForgery::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->plugins([
                FilamentShieldPlugin::make(),
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->navigationItems([
                NavigationItem::make('Horizon')
                    ->url(fn (): string => url('horizon'), shouldOpenInNewTab: true)
                    ->icon('heroicon-o-queue-list')
                    ->group('System Monitoring')
                    ->visible(fn (): bool => auth()->user()->can('view_horizon')),
                NavigationItem::make('Telescope')
                    ->url(fn (): string => url('telescope'), shouldOpenInNewTab: true)
                    ->icon('heroicon-o-sparkles')
                    ->group('System Monitoring')
                    ->visible(fn (): bool => auth()->user()->can('view_telescope')),
            ]);

        foreach (Module::allEnabled() as $module) {
            $panel->discoverResources(
                in: $module->getPath() . '/Filament/Resources',
                for: 'Modules\\' . $module->getStudlyName() . '\\Filament\\Resources'
            );
            $panel->discoverPages(
                in: $module->getPath() . '/Filament/Pages',
                for: 'Modules\\' . $module->getStudlyName() . '\\Filament\\Pages'
            );
            $panel->discoverWidgets(
                in: $module->getPath() . '/Filament/Widgets',
                for: 'Modules\\' . $module->getStudlyName() . '\\Filament\\Widgets'
            );
        }

        return $panel;
    }
}

<?php

namespace App\Providers\Filament;

use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Biostate\FilamentMenuBuilder\FilamentMenuBuilderPlugin;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationItem;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Modules\Academic\app\Filament\Resources\AcademicEvent\AcademicEventResource;
use Modules\Academic\app\Filament\Resources\AcademicSession\AcademicSessionResource;
use Modules\Academic\app\Filament\Resources\Committee\CommitteeResource;
use Modules\Academic\app\Filament\Resources\Course\CourseResource;
use Modules\Academic\app\Filament\Resources\Department\DepartmentResource;
use Modules\Academic\app\Filament\Resources\Faculty\FacultyResource;
use Modules\Academic\app\Filament\Resources\FacultyMember\FacultyMemberResource;
use Modules\Academic\app\Filament\Resources\Program\ProgramResource;
use Modules\Academic\app\Filament\Resources\ProgramType\ProgramTypeResource;
use Modules\Academic\app\Filament\Resources\ResearchInterest\ResearchInterestResource;
use Modules\Academic\app\Filament\Resources\TuitionType\TuitionTypeResource;
use Modules\CMS\app\Filament\Resources\Page\PageResource;
use Modules\Theme\app\Filament\Resources\Theme\ThemeResource;
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
                FilamentMenuBuilderPlugin::make(),
            ])
            ->resources([
                CourseResource::class,
                FacultyMemberResource::class,
                DepartmentResource::class,
                FacultyResource::class,
                ProgramResource::class,
                ProgramTypeResource::class,
                TuitionTypeResource::class,
                ResearchInterestResource::class,
                AcademicSessionResource::class,
                AcademicEventResource::class,
                CommitteeResource::class,
                PageResource::class,
                ThemeResource::class,
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
                in: $module->getPath().'/app/Filament/Resources',
                for: 'Modules\\'.$module->getStudlyName().'\\app\\Filament\\Resources'
            );
            $panel->discoverPages(
                in: $module->getPath().'/app/Filament/Pages',
                for: 'Modules\\'.$module->getStudlyName().'\\app\\Filament\\Pages'
            );
            $panel->discoverWidgets(
                in: $module->getPath().'/app/Filament/Widgets',
                for: 'Modules\\'.$module->getStudlyName().'\\app\\Filament\\Widgets'
            );
        }

        return $panel;
    }
}

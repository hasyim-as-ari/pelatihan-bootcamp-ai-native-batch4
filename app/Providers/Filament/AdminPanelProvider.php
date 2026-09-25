<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\View\PanelsRenderHook;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login(\App\Filament\Pages\Auth\Login::class)
            ->brandName('FOAMS - API Banyuwangi')
            ->favicon(asset('images/logo/logo_api.png'))
            ->brandLogo(fn () => view('filament.components.brand-logo'))
            ->brandLogoHeight('2.4rem')
            ->darkMode(false)
            ->renderHook(
                PanelsRenderHook::HEAD_END,
                fn () => view('filament.components.theme-styles')
            )
            ->renderHook(
                PanelsRenderHook::SIDEBAR_FOOTER,
                fn () => view('filament.components.sidebar-logout')
            )
            ->renderHook(
                PanelsRenderHook::TOPBAR_LOGO_AFTER,
                fn () => view('filament.components.topbar-clock')
            )
            ->colors([
                'primary' => Color::hex('#0066ee'),
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->navigationGroups([
                NavigationGroup::make('Master Data')
                    ->label('Master Data')
                    ->collapsible()
                    ->collapsed(false),

                NavigationGroup::make('Flight Scheduling')
                    ->label('Flight Scheduling')
                    ->collapsible()
                    ->collapsed(false),

                NavigationGroup::make('Flight Operations')
                    ->label('Flight Operations')
                    ->collapsible()
                    ->collapsed(false),

                NavigationGroup::make('Reports & History')
                    ->label('Reports & History')
                    ->collapsible()
                    ->collapsed(false),

                NavigationGroup::make('Settings')
                    ->label('Settings')
                    ->collapsible()
                    ->collapsed(true),
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                AccountWidget::class,
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
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}

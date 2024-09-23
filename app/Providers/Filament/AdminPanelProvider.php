<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Navigation\NavigationGroup;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Assets\Css;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Vite;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->brandName('Tuning Factory')
            ->brandLogo(asset('images/logo.png'))
            ->login()
            ->profile()
            ->colors([
                'primary' => Color::Lime,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->navigationGroups([
                NavigationGroup::make()
                    ->label('Administration'),

                NavigationGroup::make()
                    ->label('Master Data'),

                NavigationGroup::make('Settings')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->collapsed(true),
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->userMenuItems([
                MenuItem::make()
                    ->label(fn (): string => \App\Filament\Pages\AccountSettings::getNavigationLabel())
                    ->url(fn (): string => \App\Filament\Pages\AccountSettings::getUrl())
                    ->icon(fn (): string => \App\Filament\Pages\AccountSettings::getNavigationIcon()),

                MenuItem::make()
                    ->label(fn (): string => \App\Filament\Pages\ApiTokens::getNavigationLabel())
                    ->url(fn (): string => \App\Filament\Pages\ApiTokens::getUrl())
                    ->icon(fn (): string => \App\Filament\Pages\ApiTokens::getNavigationIcon()),
            ])
            ->assets([
                Css::make('app', Vite::asset('resources/css/app.css')),
            ]);
    }
}

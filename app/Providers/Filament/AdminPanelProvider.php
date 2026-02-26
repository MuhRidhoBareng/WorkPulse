<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
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
            ->brandName('SPNF SKB Kota Kotamobagu')
            ->brandLogo(new \Illuminate\Support\HtmlString(
                '<div style="display:flex;align-items:center;gap:0.625rem;">' .
                    '<img src="' . asset('images/logo-kemendikdasmen.jpg') . '" style="height:2.25rem;width:auto;border-radius:0.375rem;flex-shrink:0;" alt="Kemendikdasmen">' .
                    '<img src="' . asset('images/logo-kotamobagu.png') . '" style="height:2.25rem;width:auto;flex-shrink:0;" alt="Kotamobagu">' .
                    '<div style="display:flex;flex-direction:column;">' .
                        '<span style="font-size:0.875rem;font-weight:700;color:#1e293b;line-height:1.2;">SPNF SKB</span>' .
                        '<span style="font-size:0.625rem;color:#94a3b8;line-height:1.2;">Kota Kotamobagu</span>' .
                    '</div>' .
                '</div>'
            ))
            ->brandLogoHeight('3.5rem')
            ->colors([
                'primary' => Color::Blue,
                'gray' => Color::Slate,
                'info' => Color::Blue,
                'success' => Color::Emerald,
                'warning' => Color::Orange,
                'danger' => Color::Rose,
            ])
            ->font('Figtree')
            ->sidebarCollapsibleOnDesktop()
            ->globalSearch(false)
            ->renderHook(
                \Filament\View\PanelsRenderHook::HEAD_END,
                fn () => view('filament.custom-styles'),
            )
            ->renderHook(
                \Filament\View\PanelsRenderHook::FOOTER,
                fn () => view('filament.footer'),
            )
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                \App\Filament\Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                \App\Filament\Widgets\StatsOverview::class,
                \App\Filament\Widgets\ApprovedReportsSlideshow::class,
                \App\Filament\Widgets\AttendanceChart::class,
                \App\Filament\Widgets\ActivityReportChart::class,
                \App\Filament\Widgets\PamongPerformanceChart::class,
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
                \App\Http\Middleware\FilamentRedirectToLogin::class,
            ]);
    }
}

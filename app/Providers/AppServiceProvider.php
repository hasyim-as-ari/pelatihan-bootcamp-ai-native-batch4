<?php

namespace App\Providers;

use App\Models\ActivityLog;
use App\Models\LoginHistory;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use BezhanSalleh\LanguageSwitch\LanguageSwitch;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
            $switch
                ->locales(['en', 'id'])
                ->nativeLabel()
                ->circular();
        });

        Event::listen(Login::class, function (Login $event) {
            if ($event->user) {
                // Record to activity log
                ActivityLog::record(
                    userId: $event->user->getAuthIdentifier(),
                    actionType: 'LOGIN',
                    moduleName: 'Authentication',
                    description: 'User ' . ($event->user->name ?? 'User') . ' (' . ($event->user->email ?? '') . ') logged in successfully',
                    ipAddress: request()?->ip() ?? '127.0.0.1',
                    userAgent: request()?->userAgent() ?? 'Browser'
                );
                // Record to login history
                LoginHistory::record(
                    userId: $event->user->getAuthIdentifier(),
                    email: $event->user->email ?? '',
                    status: 'success',
                );
            }
        });

        Event::listen(Logout::class, function (Logout $event) {
            if ($event->user) {
                ActivityLog::record(
                    userId: $event->user->getAuthIdentifier(),
                    actionType: 'LOGOUT',
                    moduleName: 'Authentication',
                    description: 'Pengguna ' . ($event->user->name ?? 'User') . ' (' . ($event->user->email ?? '') . ') keluar dari sistem',
                    ipAddress: request()?->ip() ?? '127.0.0.1',
                    userAgent: request()?->userAgent() ?? 'Browser'
                );
            }
        });
    }
}

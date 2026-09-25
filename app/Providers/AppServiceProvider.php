<?php

namespace App\Providers;

use App\Models\ActivityLog;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

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
        Event::listen(Login::class, function (Login $event) {
            if ($event->user) {
                ActivityLog::record(
                    userId: $event->user->getAuthIdentifier(),
                    actionType: 'LOGIN',
                    moduleName: 'Authentication',
                    description: 'Pengguna ' . ($event->user->name ?? 'User') . ' (' . ($event->user->email ?? '') . ') berhasil masuk ke sistem',
                    ipAddress: request()?->ip() ?? '127.0.0.1',
                    userAgent: request()?->userAgent() ?? 'Browser'
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

<?php

namespace App\Filament\Pages\Auth;

use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use Filament\Auth\Http\Responses\Contracts\LoginResponse;
use Filament\Auth\Pages\Login as BaseLogin;
use Filament\Facades\Filament;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Auth\Events\Attempting;
use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\SessionGuard;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Timebox;
use Illuminate\Validation\ValidationException;

class Login extends BaseLogin
{
    protected string $view = 'filament.pages.auth.login';

    protected static string $layout = 'filament-panels::components.layout.base';

    public function mount(): void
    {
        if (Filament::auth()->check()) {
            redirect()->intended(Filament::getUrl());
        }

        $this->data = [
            'email' => '',
            'password' => '',
            'remember' => false,
        ];
    }

    public function authenticate(): ?LoginResponse
    {
        try {
            $this->rateLimit(5);
        } catch (TooManyRequestsException $exception) {
            $this->getRateLimitedNotification($exception)?->send();

            return null;
        }

        $this->validate([
            'data.email' => ['required', 'string', 'email'],
            'data.password' => ['required', 'string'],
        ], [
            'data.email.required' => 'Email wajib diisi.',
            'data.email.email' => 'Format email tidak valid.',
            'data.password.required' => 'Password wajib diisi.',
        ]);

        $credentials = [
            'email' => $this->data['email'] ?? '',
            'password' => $this->data['password'] ?? '',
        ];
        $remember = (bool) ($this->data['remember'] ?? false);

        /** @var SessionGuard $authGuard */
        $authGuard = Filament::auth();
        $authProvider = $authGuard->getProvider();
        $timeboxDuration = (int) config('auth.timebox_duration', 200_000);

        $user = app(Timebox::class)->call(function (Timebox $timebox) use ($authProvider, $authGuard, $credentials, $remember): Authenticatable {
            event(app(Attempting::class, [
                'guard' => property_exists($authGuard, 'name') ? $authGuard->name : '',
                'credentials' => $credentials,
                'remember' => $remember,
            ]));

            $user = $authProvider->retrieveByCredentials($credentials);

            if ((! $user) || (! $authProvider->validateCredentials($user, $credentials))) {
                event(app(Failed::class, [
                    'guard' => property_exists($authGuard, 'name') ? $authGuard->name : '',
                    'user' => $user,
                    'credentials' => $credentials,
                ]));

                throw ValidationException::withMessages([
                    'data.email' => 'Email atau password yang Anda masukkan salah.',
                ]);
            }

            return $user;
        }, $timeboxDuration);

        $panel = Filament::getCurrentPanel() ?? Filament::getPanel('admin');

        if (
            ($user instanceof FilamentUser) &&
            $panel &&
            (! $user->canAccessPanel($panel))
        ) {
            Filament::auth()->logout();

            throw ValidationException::withMessages([
                'data.email' => 'Akun Anda tidak memiliki akses ke panel ini.',
            ]);
        }

        Filament::auth()->login($user, $remember);
        session()->regenerate();

        return app(LoginResponse::class);
    }
}

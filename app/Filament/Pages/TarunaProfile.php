<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class TarunaProfile extends Page
{
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationLabel = 'My Profile';

    protected static ?string $title = 'My Profile';

    protected static ?string $slug = 'my-profile';

    protected static ?int $navigationSort = 10;

    protected string $view = 'filament.pages.taruna-profile';

    public ?string $no_telepon = '';

    public static function canAccess(): bool
    {
        $user = auth()->user();

        return $user && $user->hasRole('taruna');
    }

    public function mount(): void
    {
        $user = auth()->user();
        $taruna = $user?->taruna;

        if ($taruna) {
            $this->no_telepon = $taruna->no_telepon;
        }
    }

    public function save(): void
    {
        $user = auth()->user();
        $taruna = $user?->taruna;

        if (! $taruna) {
            Notification::make()
                ->title('Cadet record not found')
                ->danger()
                ->send();

            return;
        }

        $this->validate([
            'no_telepon' => 'nullable|string|max:30',
        ]);

        $taruna->update([
            'no_telepon' => $this->no_telepon,
        ]);

        Notification::make()
            ->title('Profile updated successfully')
            ->success()
            ->send();
    }

    public function getViewData(): array
    {
        $user = auth()->user();
        $taruna = $user?->taruna;

        $recentFlights = $taruna
            ? $taruna->jadwalPenerbangan()
                ->with(['instruktur', 'pesawat'])
                ->latest('tanggal')
                ->limit(5)
                ->get()
            : collect();

        $modules = $taruna
            ? $taruna->modulPenerbangan()->get()
            : collect();

        $totalHours = $taruna ? (float) $taruna->total_jam_terbang : 0;
        $quotaHours = $taruna ? (float) $taruna->kuota_jam_terbang : 0;
        $progressPct = ($quotaHours > 0) ? min(100, round(($totalHours / $quotaHours) * 100)) : 0;

        return [
            'user' => $user,
            'taruna' => $taruna,
            'recentFlights' => $recentFlights,
            'modules' => $modules,
            'totalHours' => $totalHours,
            'quotaHours' => $quotaHours,
            'progressPct' => $progressPct,
        ];
    }
}

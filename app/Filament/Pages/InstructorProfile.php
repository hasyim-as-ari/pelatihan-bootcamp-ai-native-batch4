<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class InstructorProfile extends Page
{
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-user-circle';

    protected static ?string $navigationLabel = 'My Profile & Availability';

    protected static ?string $title = 'My Profile & Availability';

    protected static ?string $slug = 'my-profile-availability';

    protected static ?int $navigationSort = 10;

    protected string $view = 'filament.pages.instructor-profile';

    public ?string $no_telepon = '';

    public ?string $max_jam_terbang_harian = '';

    public ?string $catatan = '';

    public static function canAccess(): bool
    {
        $user = auth()->user();

        return $user && $user->hasRole('instruktur');
    }

    public function mount(): void
    {
        $user = auth()->user();
        $instruktur = $user?->instruktur;

        if ($instruktur) {
            $this->no_telepon = $instruktur->no_telepon;
            $this->max_jam_terbang_harian = (string) $instruktur->max_jam_terbang_harian;
            $this->catatan = $instruktur->catatan;
        }
    }

    public function save(): void
    {
        $user = auth()->user();
        $instruktur = $user?->instruktur;

        if (! $instruktur) {
            Notification::make()
                ->title('Instructor record not found')
                ->danger()
                ->send();

            return;
        }

        $this->validate([
            'no_telepon' => 'nullable|string|max:30',
            'max_jam_terbang_harian' => 'nullable|numeric|min:1|max:12',
            'catatan' => 'nullable|string|max:500',
        ]);

        $instruktur->update([
            'no_telepon' => $this->no_telepon,
            'max_jam_terbang_harian' => $this->max_jam_terbang_harian ?: 6.00,
            'catatan' => $this->catatan,
        ]);

        Notification::make()
            ->title('Profile & Availability updated successfully')
            ->success()
            ->send();
    }

    public function getViewData(): array
    {
        $user = auth()->user();
        $instruktur = $user?->instruktur;

        $recentFlights = $instruktur
            ? $instruktur->jadwalPenerbangan()
                ->with(['taruna', 'pesawat'])
                ->latest('tanggal')
                ->limit(5)
                ->get()
            : collect();

        $totalTeachingHours = $instruktur
            ? (float) $instruktur->flightLog()->where('status', 'completed')->sum('durasi_terbang')
            : 0;

        return [
            'user' => $user,
            'instruktur' => $instruktur,
            'recentFlights' => $recentFlights,
            'totalTeachingHours' => $totalTeachingHours,
        ];
    }
}

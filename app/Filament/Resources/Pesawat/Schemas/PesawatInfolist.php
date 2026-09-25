<?php

namespace App\Filament\Resources\Pesawat\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PesawatInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nomor_registrasi')
                    ->label('Registration Number (Tail No.)'),
                TextEntry::make('tipe_pesawat')
                    ->label('Aircraft Model / Type'),
                TextEntry::make('nama_pesawat')
                    ->label('Callsign / Name')
                    ->placeholder('-'),
                TextEntry::make('total_jam_terbang')
                    ->label('Total Airframe Hours')
                    ->numeric(),
                TextEntry::make('jam_terbang_sebelum_maintenance')
                    ->label('Hours Until Next Maintenance')
                    ->numeric(),
                TextEntry::make('status')
                    ->label('Fleet Readiness Status')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'available' => 'Available',
                        'in_use' => 'In Flight',
                        'maintenance' => 'Maintenance',
                        'grounded' => 'Grounded',
                        default => ucfirst($state),
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'available' => 'success',
                        'in_use' => 'primary',
                        'maintenance' => 'warning',
                        'grounded' => 'danger',
                        default => 'gray',
                    }),
                TextEntry::make('tanggal_maintenance_terakhir')
                    ->label('Last Maintenance Date')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('tanggal_maintenance_berikutnya')
                    ->label('Next Scheduled Maintenance')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('kapasitas_penumpang')
                    ->label('Seating Capacity')
                    ->numeric(),
                TextEntry::make('catatan')
                    ->label('Maintenance Notes / Remarks')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->label('Added At')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->label('Updated At')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}

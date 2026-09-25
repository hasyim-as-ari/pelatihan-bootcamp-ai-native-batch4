<?php

namespace App\Filament\Resources\JadwalPenerbangan\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class JadwalPenerbanganInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('kode_jadwal')
                    ->label('Schedule Code'),
                TextEntry::make('tanggal')
                    ->label('Flight Date')
                    ->date('M d, Y'),
                TextEntry::make('jam_mulai')
                    ->label('Start Time')
                    ->time('H:i'),
                TextEntry::make('jam_selesai')
                    ->label('End Time')
                    ->time('H:i'),
                TextEntry::make('taruna.nama')
                    ->label('Student / Cadet'),
                TextEntry::make('instruktur.nama')
                    ->label('Flight Instructor'),
                TextEntry::make('pesawat.nomor_registrasi')
                    ->label('Aircraft (Tail No.)'),
                TextEntry::make('rute_area_latihan')
                    ->label('Training Route / Area')
                    ->placeholder('-'),
                TextEntry::make('modul_penerbangan')
                    ->label('Flight Module')
                    ->placeholder('-'),
                TextEntry::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'draft' => 'Draft',
                        'scheduled' => 'Scheduled',
                        'in_flight' => 'In Flight',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                        'rescheduled' => 'Rescheduled',
                        default => ucfirst($state),
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'draft' => 'gray',
                        'scheduled' => 'info',
                        'in_flight' => 'warning',
                        'completed' => 'success',
                        'cancelled' => 'danger',
                        'rescheduled' => 'primary',
                        default => 'gray',
                    }),
                TextEntry::make('catatan')
                    ->label('Flight Notes / Briefing')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->label('Updated At')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}

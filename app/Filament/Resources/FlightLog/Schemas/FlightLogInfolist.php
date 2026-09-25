<?php

namespace App\Filament\Resources\FlightLog\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class FlightLogInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('jadwalPenerbangan.kode_jadwal')
                    ->label('Flight Schedule'),
                TextEntry::make('taruna.nama')
                    ->label('Student / Cadet'),
                TextEntry::make('instruktur.nama')
                    ->label('Flight Instructor'),
                TextEntry::make('pesawat.nomor_registrasi')
                    ->label('Aircraft'),
                TextEntry::make('tanggal')
                    ->label('Date')
                    ->date(),
                TextEntry::make('jam_takeoff')
                    ->label('Takeoff Time')
                    ->time()
                    ->placeholder('-'),
                TextEntry::make('jam_landing')
                    ->label('Landing Time')
                    ->time()
                    ->placeholder('-'),
                TextEntry::make('durasi_terbang')
                    ->label('Flight Duration (Hours)')
                    ->numeric(),
                TextEntry::make('status')
                    ->label('Status')
                    ->badge(),
                TextEntry::make('catatan_evaluasi')
                    ->label('Evaluation Notes')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('nilai')
                    ->label('Score')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('hasil_evaluasi')
                    ->label('Evaluation Result')
                    ->badge()
                    ->formatStateUsing(fn (?string $state): ?string => match ($state) {
                        'lulus' => 'Pass',
                        'tidak_lulus' => 'Fail',
                        'perlu_pengulangan' => 'Retake Required',
                        default => $state ? ucfirst(str_replace('_', ' ', $state)) : null,
                    })
                    ->placeholder('-'),
                TextEntry::make('kondisi_cuaca')
                    ->label('Weather Condition')
                    ->placeholder('-'),
                TextEntry::make('recorded_by')
                    ->label('Recorded By')
                    ->numeric()
                    ->placeholder('-'),
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



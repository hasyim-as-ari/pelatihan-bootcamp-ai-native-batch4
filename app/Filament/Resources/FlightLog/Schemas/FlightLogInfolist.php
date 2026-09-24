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
                    ->label('Jadwal penerbangan'),
                TextEntry::make('taruna.nama')
                    ->label('Taruna'),
                TextEntry::make('instruktur.nama')
                    ->label('Instruktur'),
                TextEntry::make('pesawat.nomor_registrasi')
                    ->label('Pesawat'),
                TextEntry::make('tanggal')
                    ->date(),
                TextEntry::make('jam_takeoff')
                    ->time()
                    ->placeholder('-'),
                TextEntry::make('jam_landing')
                    ->time()
                    ->placeholder('-'),
                TextEntry::make('durasi_terbang')
                    ->numeric(),
                TextEntry::make('status')
                    ->badge(),
                TextEntry::make('catatan_evaluasi')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('nilai')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('hasil_evaluasi')
                    ->badge()
                    ->placeholder('-'),
                TextEntry::make('kondisi_cuaca')
                    ->placeholder('-'),
                TextEntry::make('recorded_by')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}



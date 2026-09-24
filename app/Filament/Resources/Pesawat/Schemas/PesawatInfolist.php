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
                TextEntry::make('nomor_registrasi'),
                TextEntry::make('tipe_pesawat'),
                TextEntry::make('nama_pesawat')
                    ->placeholder('-'),
                TextEntry::make('total_jam_terbang')
                    ->numeric(),
                TextEntry::make('jam_terbang_sebelum_maintenance')
                    ->numeric(),
                TextEntry::make('status')
                    ->badge(),
                TextEntry::make('tanggal_maintenance_terakhir')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('tanggal_maintenance_berikutnya')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('kapasitas_penumpang')
                    ->numeric(),
                TextEntry::make('catatan')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}


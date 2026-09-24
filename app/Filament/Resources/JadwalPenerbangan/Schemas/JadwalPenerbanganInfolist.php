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
                TextEntry::make('kode_jadwal'),
                TextEntry::make('tanggal')
                    ->date(),
                TextEntry::make('jam_mulai')
                    ->time(),
                TextEntry::make('jam_selesai')
                    ->time(),
                TextEntry::make('taruna.nama')
                    ->label('Taruna'),
                TextEntry::make('instruktur.nama')
                    ->label('Instruktur'),
                TextEntry::make('pesawat.nomor_registrasi')
                    ->label('Pesawat'),
                TextEntry::make('rute_area_latihan')
                    ->placeholder('-'),
                TextEntry::make('modul_penerbangan')
                    ->placeholder('-'),
                TextEntry::make('status')
                    ->badge(),
                TextEntry::make('catatan')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_by')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('approved_by')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('published_at')
                    ->dateTime()
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



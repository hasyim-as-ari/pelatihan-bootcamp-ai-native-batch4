<?php

namespace App\Filament\Resources\Taruna\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TarunaInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('user.name')
                    ->label('User'),
                TextEntry::make('nim'),
                TextEntry::make('nama'),
                TextEntry::make('no_telepon')
                    ->placeholder('-'),
                TextEntry::make('angkatan')
                    ->placeholder('-'),
                TextEntry::make('batch')
                    ->label('Batch')
                    ->placeholder('-'),
                TextEntry::make('status_batch')
                    ->label('Status Batch')
                    ->badge()
                    ->placeholder('-'),
                TextEntry::make('program_study')
                    ->label('Program Study')
                    ->placeholder('-'),
                TextEntry::make('modulPenerbangan.nama_modul')
                    ->label('Modul Penerbangan')
                    ->badge()
                    ->separator(', ')
                    ->placeholder(fn ($record) => $record->modul_penerbangan ?: '-'),
                TextEntry::make('total_jam_terbang')
                    ->numeric(),
                TextEntry::make('kuota_jam_terbang')
                    ->numeric(),
                TextEntry::make('sisa_kuota_jam_terbang')
                    ->numeric(),
                TextEntry::make('max_jam_terbang_harian')
                    ->numeric(),
                TextEntry::make('status')
                    ->badge(),
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


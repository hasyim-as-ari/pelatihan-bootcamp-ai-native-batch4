<?php

namespace App\Filament\Resources\RuteAreaLatihan\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class RuteAreaLatihanInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('kode_rute')
                    ->label('Kode Rute')
                    ->placeholder('-'),
                TextEntry::make('nama_rute')
                    ->label('Nama Rute'),
                TextEntry::make('kategori')
                    ->label('Kategori')
                    ->badge(),
                TextEntry::make('estimasi_durasi_jam')
                    ->label('Estimasi Durasi (Jam)'),
                IconEntry::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
                TextEntry::make('deskripsi')
                    ->label('Deskripsi')
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

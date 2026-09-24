<?php

namespace App\Filament\Resources\ModulPenerbangan\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ModulPenerbanganInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('kode_modul')
                    ->label('Kode Modul')
                    ->placeholder('-'),
                TextEntry::make('nama_modul')
                    ->label('Nama Modul'),
                TextEntry::make('lisensi_target')
                    ->label('Lisensi Target')
                    ->badge(),
                TextEntry::make('kategori')
                    ->label('Kategori')
                    ->placeholder('-'),
                TextEntry::make('standar_jam_terbang')
                    ->label('Standar Jam Terbang (Jam)'),
                IconEntry::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
                TextEntry::make('deskripsi')
                    ->label('Silabus / Sasaran Pelatihan')
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

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
                    ->label('Module Code')
                    ->placeholder('-'),
                TextEntry::make('nama_modul')
                    ->label('Flight Module Name'),
                TextEntry::make('lisensi_target')
                    ->label('License Target')
                    ->badge(),
                TextEntry::make('kategori')
                    ->label('Category')
                    ->placeholder('-'),
                TextEntry::make('standar_jam_terbang')
                    ->label('Standard Flight Hours (Hours)'),
                IconEntry::make('is_active')
                    ->label('Active')
                    ->boolean(),
                TextEntry::make('deskripsi')
                    ->label('Syllabus / Training Objectives')
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

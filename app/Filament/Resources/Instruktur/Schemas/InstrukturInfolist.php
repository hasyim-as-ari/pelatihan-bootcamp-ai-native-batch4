<?php

namespace App\Filament\Resources\Instruktur\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class InstrukturInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('user.name')
                    ->label('User'),
                TextEntry::make('nidn'),
                TextEntry::make('nama'),
                TextEntry::make('no_telepon')
                    ->placeholder('-'),
                TextEntry::make('lisensi')
                    ->placeholder('-'),
                TextEntry::make('max_jam_terbang_harian')
                    ->numeric(),
                TextEntry::make('total_jam_terbang')
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


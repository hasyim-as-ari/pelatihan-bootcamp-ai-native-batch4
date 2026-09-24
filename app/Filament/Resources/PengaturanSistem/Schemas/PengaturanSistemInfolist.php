<?php

namespace App\Filament\Resources\PengaturanSistem\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PengaturanSistemInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('kunci'),
                TextEntry::make('nilai')
                    ->columnSpanFull(),
                TextEntry::make('tipe_data'),
                TextEntry::make('grup'),
                TextEntry::make('deskripsi')
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


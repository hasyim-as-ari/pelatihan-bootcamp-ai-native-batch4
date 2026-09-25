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
                TextEntry::make('kunci')
                    ->label('Setting Key'),
                TextEntry::make('nilai')
                    ->label('Setting Value')
                    ->columnSpanFull(),
                TextEntry::make('tipe_data')
                    ->label('Data Type')
                    ->badge(),
                TextEntry::make('grup')
                    ->label('Group')
                    ->badge(),
                TextEntry::make('deskripsi')
                    ->label('Description')
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


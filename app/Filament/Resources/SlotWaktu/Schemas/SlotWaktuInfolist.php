<?php

namespace App\Filament\Resources\SlotWaktu\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SlotWaktuInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nama_slot')
                    ->label('Slot Name'),
                TextEntry::make('jam_mulai')
                    ->label('Start Time')
                    ->time(),
                TextEntry::make('jam_selesai')
                    ->label('End Time')
                    ->time(),
                TextEntry::make('durasi_jam')
                    ->label('Duration (Hours)')
                    ->numeric(),
                IconEntry::make('is_active')
                    ->label('Active')
                    ->boolean(),
                TextEntry::make('urutan')
                    ->label('Sort Order')
                    ->numeric(),
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


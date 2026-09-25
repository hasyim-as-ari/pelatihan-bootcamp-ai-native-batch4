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
                    ->label('Route Code')
                    ->placeholder('-'),
                TextEntry::make('nama_rute')
                    ->label('Route / Training Area Name'),
                TextEntry::make('kategori')
                    ->label('Category')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'Area Latihan Lokal' => 'Local Training Area',
                        'Sirkuit Lokal' => 'Local Circuit',
                        'Navigasi Cross Country' => 'Cross Country Navigation',
                        default => $state,
                    }),
                TextEntry::make('estimasi_durasi_jam')
                    ->label('Estimated Duration (Hours)'),
                IconEntry::make('is_active')
                    ->label('Active')
                    ->boolean(),
                TextEntry::make('deskripsi')
                    ->label('Description')
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

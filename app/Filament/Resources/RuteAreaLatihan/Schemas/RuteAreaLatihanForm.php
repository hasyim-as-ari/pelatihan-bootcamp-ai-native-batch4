<?php

namespace App\Filament\Resources\RuteAreaLatihan\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class RuteAreaLatihanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('kode_rute')
                    ->label('Kode Rute')
                    ->placeholder('Contoh: TRA-W1, XC-BWX-SUB')
                    ->unique(ignoreRecord: true),
                TextInput::make('nama_rute')
                    ->label('Nama Rute / Area Latihan')
                    ->required()
                    ->placeholder('Contoh: Banyuwangi - Area Latihan Utara'),
                Select::make('kategori')
                    ->label('Kategori')
                    ->options([
                        'Area Latihan Lokal' => 'Area Latihan Lokal',
                        'Sirkuit Lokal' => 'Sirkuit Lokal',
                        'Navigasi Cross Country' => 'Navigasi Cross Country',
                    ])
                    ->default('Area Latihan Lokal')
                    ->required(),
                TextInput::make('estimasi_durasi_jam')
                    ->label('Estimasi Durasi (Jam)')
                    ->numeric()
                    ->default(1.50)
                    ->required(),
                Textarea::make('deskripsi')
                    ->label('Deskripsi / Area Latihan')
                    ->placeholder('Penjelasan area latihan, batas ketinggian, atau koordinat')
                    ->columnSpanFull(),
                Toggle::make('is_active')
                    ->label('Status Aktif')
                    ->default(true),
            ]);
    }
}

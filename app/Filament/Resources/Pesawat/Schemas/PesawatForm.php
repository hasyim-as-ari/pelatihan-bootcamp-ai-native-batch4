<?php

namespace App\Filament\Resources\Pesawat\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PesawatForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nomor_registrasi')
                    ->required(),
                TextInput::make('tipe_pesawat')
                    ->required(),
                TextInput::make('nama_pesawat')
                    ->default(null),
                TextInput::make('total_jam_terbang')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('jam_terbang_sebelum_maintenance')
                    ->required()
                    ->numeric()
                    ->default(100.0),
                Select::make('status')
                    ->options([
            'available' => 'Available',
            'in_use' => 'In use',
            'maintenance' => 'Maintenance',
            'grounded' => 'Grounded',
        ])
                    ->default('available')
                    ->required(),
                DatePicker::make('tanggal_maintenance_terakhir'),
                DatePicker::make('tanggal_maintenance_berikutnya'),
                TextInput::make('kapasitas_penumpang')
                    ->required()
                    ->numeric()
                    ->default(2),
                Textarea::make('catatan')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}


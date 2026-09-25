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
                    ->label('Registration Number (Tail Number)')
                    ->placeholder('e.g. PK-API01')
                    ->required(),

                TextInput::make('tipe_pesawat')
                    ->label('Aircraft Model / Type')
                    ->placeholder('e.g. Cessna 172S Skyhawk')
                    ->required(),

                TextInput::make('nama_pesawat')
                    ->label('Aircraft Name / Callsign')
                    ->placeholder('e.g. Garuda Alpha')
                    ->default(null),

                TextInput::make('total_jam_terbang')
                    ->label('Total Airframe Hours')
                    ->required()
                    ->numeric()
                    ->default(0.0),

                TextInput::make('jam_terbang_sebelum_maintenance')
                    ->label('Hours Until Next Maintenance')
                    ->required()
                    ->numeric()
                    ->default(100.0)
                    ->helperText('Flight hours remaining until 50hr/100hr inspection'),

                Select::make('status')
                    ->label('Fleet Readiness Status')
                    ->options([
                        'available' => 'Available (Airworthy)',
                        'in_use' => 'In Flight / Active Mission',
                        'maintenance' => 'Under Maintenance',
                        'grounded' => 'Grounded (AOG)',
                    ])
                    ->default('available')
                    ->required(),

                DatePicker::make('tanggal_maintenance_terakhir')
                    ->label('Last Maintenance Date'),

                DatePicker::make('tanggal_maintenance_berikutnya')
                    ->label('Next Scheduled Maintenance Date'),

                TextInput::make('kapasitas_penumpang')
                    ->label('Seating Capacity')
                    ->required()
                    ->numeric()
                    ->default(2),

                Textarea::make('catatan')
                    ->label('Maintenance Notes / Remarks')
                    ->placeholder('Logbook entries, squawk reports, or maintenance history')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}

<?php

namespace App\Filament\Resources\FlightLog\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Schema;

class FlightLogForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('jadwal_penerbangan_id')
                    ->relationship('jadwalPenerbangan', 'kode_jadwal')
                    ->required(),
                Select::make('taruna_id')
                    ->relationship('taruna', 'nama')
                    ->required(),
                Select::make('instruktur_id')
                    ->relationship('instruktur', 'nama')
                    ->required(),
                Select::make('pesawat_id')
                    ->relationship('pesawat', 'nomor_registrasi')
                    ->required(),
                DatePicker::make('tanggal')
                    ->required(),
                TimePicker::make('jam_takeoff'),
                TimePicker::make('jam_landing'),
                TextInput::make('durasi_terbang')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                Select::make('status')
                    ->options(['in_progress' => 'In progress', 'completed' => 'Completed', 'cancelled' => 'Cancelled'])
                    ->default('in_progress')
                    ->required(),
                Textarea::make('catatan_evaluasi')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('nilai')
                    ->numeric()
                    ->default(null),
                Select::make('hasil_evaluasi')
                    ->options(['lulus' => 'Lulus', 'tidak_lulus' => 'Tidak lulus', 'perlu_pengulangan' => 'Perlu pengulangan'])
                    ->default(null),
                TextInput::make('kondisi_cuaca')
                    ->default(null),
                TextInput::make('recorded_by')
                    ->numeric()
                    ->default(null),
            ]);
    }
}


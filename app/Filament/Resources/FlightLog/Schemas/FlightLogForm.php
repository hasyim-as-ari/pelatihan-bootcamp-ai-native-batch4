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
                    ->label('Flight Schedule')
                    ->relationship('jadwalPenerbangan', 'kode_jadwal')
                    ->required(),
                Select::make('taruna_id')
                    ->label('Student / Cadet')
                    ->relationship('taruna', 'nama')
                    ->required(),
                Select::make('instruktur_id')
                    ->label('Flight Instructor')
                    ->relationship('instruktur', 'nama')
                    ->required(),
                Select::make('pesawat_id')
                    ->label('Aircraft')
                    ->relationship('pesawat', 'nomor_registrasi')
                    ->required(),
                DatePicker::make('tanggal')
                    ->label('Flight Date')
                    ->required(),
                TimePicker::make('jam_takeoff')
                    ->label('Takeoff Time'),
                TimePicker::make('jam_landing')
                    ->label('Landing Time'),
                TextInput::make('durasi_terbang')
                    ->label('Flight Duration (Hours)')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                Select::make('status')
                    ->label('Status')
                    ->options([
                        'in_progress' => 'In Progress',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ])
                    ->default('in_progress')
                    ->required(),
                Textarea::make('catatan_evaluasi')
                    ->label('Evaluation Notes')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('nilai')
                    ->label('Score')
                    ->numeric()
                    ->default(null),
                Select::make('hasil_evaluasi')
                    ->label('Evaluation Result')
                    ->options([
                        'lulus' => 'Pass',
                        'tidak_lulus' => 'Fail',
                        'perlu_pengulangan' => 'Retake Required',
                    ])
                    ->default(null),
                TextInput::make('kondisi_cuaca')
                    ->label('Weather Condition')
                    ->default(null),
                TextInput::make('recorded_by')
                    ->label('Recorded By (User ID)')
                    ->numeric()
                    ->default(null),
            ]);
    }
}


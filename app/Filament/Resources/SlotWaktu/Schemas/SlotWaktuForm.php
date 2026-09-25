<?php

namespace App\Filament\Resources\SlotWaktu\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SlotWaktuForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_slot')
                    ->label('Slot Name')
                    ->placeholder('e.g., Slot 1 - Morning Departure')
                    ->required(),
                TimePicker::make('jam_mulai')
                    ->label('Start Time')
                    ->required(),
                TimePicker::make('jam_selesai')
                    ->label('End Time')
                    ->required(),
                TextInput::make('durasi_jam')
                    ->label('Duration (Hours)')
                    ->required()
                    ->numeric(),
                Toggle::make('is_active')
                    ->label('Active Status')
                    ->default(true)
                    ->required(),
                TextInput::make('urutan')
                    ->label('Sort Order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}


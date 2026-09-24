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
                    ->required(),
                TimePicker::make('jam_mulai')
                    ->required(),
                TimePicker::make('jam_selesai')
                    ->required(),
                TextInput::make('durasi_jam')
                    ->required()
                    ->numeric(),
                Toggle::make('is_active')
                    ->required(),
                TextInput::make('urutan')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}


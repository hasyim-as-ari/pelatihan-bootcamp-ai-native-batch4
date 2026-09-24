<?php

namespace App\Filament\Resources\Instruktur\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class InstrukturForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                TextInput::make('nidn')
                    ->required(),
                TextInput::make('nama')
                    ->required(),
                TextInput::make('no_telepon')
                    ->tel()
                    ->default(null),
                TextInput::make('lisensi')
                    ->default(null),
                TextInput::make('max_jam_terbang_harian')
                    ->required()
                    ->numeric()
                    ->default(8.0),
                TextInput::make('total_jam_terbang')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                Select::make('status')
                    ->options(['aktif' => 'Aktif', 'cuti' => 'Cuti', 'nonaktif' => 'Nonaktif'])
                    ->default('aktif')
                    ->required(),
                Textarea::make('catatan')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}


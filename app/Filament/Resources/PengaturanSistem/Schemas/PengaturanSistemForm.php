<?php

namespace App\Filament\Resources\PengaturanSistem\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PengaturanSistemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('kunci')
                    ->required(),
                Textarea::make('nilai')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('tipe_data')
                    ->required()
                    ->default('string'),
                TextInput::make('grup')
                    ->required()
                    ->default('umum'),
                TextInput::make('deskripsi')
                    ->default(null),
            ]);
    }
}


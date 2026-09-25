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
                    ->label('Setting Key')
                    ->required(),
                Textarea::make('nilai')
                    ->label('Setting Value')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('tipe_data')
                    ->label('Data Type')
                    ->required()
                    ->default('string'),
                TextInput::make('grup')
                    ->label('Group')
                    ->required()
                    ->default('general'),
                TextInput::make('deskripsi')
                    ->label('Description')
                    ->default(null),
            ]);
    }
}


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
                    ->label('Route Code')
                    ->placeholder('e.g., TRA-W1, XC-BWX-SUB')
                    ->unique(ignoreRecord: true),
                TextInput::make('nama_rute')
                    ->label('Route / Training Area Name')
                    ->required()
                    ->placeholder('e.g., Banyuwangi - North Training Area'),
                Select::make('kategori')
                    ->label('Category')
                    ->options([
                        'Local Training Area' => 'Local Training Area',
                        'Local Circuit' => 'Local Circuit',
                        'Cross Country Navigation' => 'Cross Country Navigation',
                        'Area Latihan Lokal' => 'Local Training Area (Legacy)',
                        'Sirkuit Lokal' => 'Local Circuit (Legacy)',
                        'Navigasi Cross Country' => 'Cross Country Navigation (Legacy)',
                    ])
                    ->default('Local Training Area')
                    ->required(),
                TextInput::make('estimasi_durasi_jam')
                    ->label('Estimated Duration (Hours)')
                    ->numeric()
                    ->default(1.50)
                    ->required(),
                Textarea::make('deskripsi')
                    ->label('Description / Training Area Boundary')
                    ->placeholder('Training area explanation, altitude limits, or airspace coordinates')
                    ->columnSpanFull(),
                Toggle::make('is_active')
                    ->label('Active Status')
                    ->default(true),
            ]);
    }
}

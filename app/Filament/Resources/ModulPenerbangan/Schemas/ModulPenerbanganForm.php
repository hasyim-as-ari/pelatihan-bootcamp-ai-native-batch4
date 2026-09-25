<?php

namespace App\Filament\Resources\ModulPenerbangan\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ModulPenerbanganForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('kode_modul')
                    ->label('Module Code')
                    ->placeholder('e.g., PPL-TP-01, CPL-XC-02')
                    ->unique(ignoreRecord: true),
                TextInput::make('nama_modul')
                    ->label('Flight Module Name')
                    ->required()
                    ->placeholder('e.g., Traffic Pattern, Touch and Go'),
                Select::make('lisensi_target')
                    ->label('License Target')
                    ->options([
                        'PPL' => 'PPL (Private Pilot License)',
                        'CPL' => 'CPL (Commercial Pilot License)',
                        'IR' => 'IR (Instrument Rating)',
                        'MER' => 'MER (Multi Engine Rating)',
                    ])
                    ->default('PPL')
                    ->required(),
                TextInput::make('kategori')
                    ->label('Maneuver Category')
                    ->placeholder('e.g., Basic Maneuvers, Visual Navigation, Emergency Procedures'),
                TextInput::make('standar_jam_terbang')
                    ->label('Standard Flight Hours per Session')
                    ->numeric()
                    ->default(1.50)
                    ->required(),
                Textarea::make('deskripsi')
                    ->label('Syllabus / Training Objectives')
                    ->placeholder('Training description, module passing requirements, evaluation checklist')
                    ->columnSpanFull(),
                Toggle::make('is_active')
                    ->label('Active Status')
                    ->default(true),
            ]);
    }
}

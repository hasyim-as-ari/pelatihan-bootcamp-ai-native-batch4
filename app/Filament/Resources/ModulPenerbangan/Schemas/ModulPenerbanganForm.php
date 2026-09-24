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
                    ->label('Kode Modul')
                    ->placeholder('Contoh: PPL-TP-01, CPL-XC-02')
                    ->unique(ignoreRecord: true),
                TextInput::make('nama_modul')
                    ->label('Nama Modul Penerbangan')
                    ->required()
                    ->placeholder('Contoh: Traffic Pattern, Touch and Go'),
                Select::make('lisensi_target')
                    ->label('Lisensi Target')
                    ->options([
                        'PPL' => 'PPL (Private Pilot License)',
                        'CPL' => 'CPL (Commercial Pilot License)',
                        'IR' => 'IR (Instrument Rating)',
                        'MER' => 'MER (Multi Engine Rating)',
                    ])
                    ->default('PPL')
                    ->required(),
                TextInput::make('kategori')
                    ->label('Kategori Manuver')
                    ->placeholder('Contoh: Manuver Dasar, Navigasi Visual, Prosedur Darurat'),
                TextInput::make('standar_jam_terbang')
                    ->label('Standar Jam Terbang per Sesi')
                    ->numeric()
                    ->default(1.50)
                    ->required(),
                Textarea::make('deskripsi')
                    ->label('Silabus / Sasaran Pelatihan')
                    ->placeholder('Deskripsi latihan, syarat kelulusan modul, checklist evaluasi')
                    ->columnSpanFull(),
                Toggle::make('is_active')
                    ->label('Status Aktif')
                    ->default(true),
            ]);
    }
}

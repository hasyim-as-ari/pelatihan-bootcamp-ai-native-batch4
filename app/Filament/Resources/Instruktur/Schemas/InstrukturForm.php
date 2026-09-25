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
                    ->label('Associated User Account')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->helperText('Login account linked to this flight instructor'),

                TextInput::make('nidn')
                    ->label('Instructor ID / License No.')
                    ->placeholder('e.g. INS-001')
                    ->required(),

                TextInput::make('nama')
                    ->label('Full Name')
                    ->placeholder('e.g. Capt. Budi Santoso')
                    ->required(),

                TextInput::make('no_telepon')
                    ->label('Phone Number')
                    ->placeholder('e.g. +62 812-3456-7890')
                    ->tel()
                    ->default(null),

                TextInput::make('lisensi')
                    ->label('Pilot License')
                    ->placeholder('e.g. ATPL, CPL, CFI')
                    ->default(null),

                TextInput::make('max_jam_terbang_harian')
                    ->label('Max Daily Flight Hours (Hours)')
                    ->required()
                    ->numeric()
                    ->default(8.0),

                TextInput::make('total_jam_terbang')
                    ->label('Total Accumulated Flight Hours (Hours)')
                    ->required()
                    ->numeric()
                    ->default(0.0),

                Select::make('status')
                    ->label('Instructor Status')
                    ->options([
                        'active' => 'Active',
                        'leave' => 'On Leave',
                        'inactive' => 'Inactive',
                        'aktif' => 'Active',
                        'cuti' => 'On Leave',
                        'nonaktif' => 'Inactive',
                    ])
                    ->default('active')
                    ->required(),

                Textarea::make('catatan')
                    ->label('Notes / Remarks')
                    ->placeholder('Special instructions, qualifications, or notes')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}

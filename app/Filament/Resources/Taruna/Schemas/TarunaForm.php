<?php

namespace App\Filament\Resources\Taruna\Schemas;

use App\Models\ModulPenerbangan;
use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class TarunaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->label('Associated User Account')
                    ->relationship('user', 'name')
                    ->getOptionLabelFromRecordUsing(fn (User $record) => "{$record->name} ({$record->email})")
                    ->searchable()
                    ->preload()
                    ->required()
                    ->helperText('Login account linked to this student / cadet'),

                TextInput::make('nim')
                    ->label('Student ID (NIM)')
                    ->placeholder('e.g. TRN-2024-001')
                    ->unique(ignoreRecord: true)
                    ->required(),

                TextInput::make('nama')
                    ->label('Full Name')
                    ->placeholder('e.g. Muhammad Rizky Pratama')
                    ->required(),

                TextInput::make('no_telepon')
                    ->label('Phone Number / WhatsApp')
                    ->tel()
                    ->placeholder('e.g. +62 812-3456-7890')
                    ->default(null),

                TextInput::make('angkatan')
                    ->label('Class Year / Intake')
                    ->placeholder('e.g. 2024')
                    ->default(fn () => date('Y')),

                TextInput::make('batch')
                    ->label('Batch')
                    ->numeric()
                    ->placeholder('e.g. 100, 101, 102')
                    ->helperText('Cadet flight training batch number'),

                TextInput::make('status_batch')
                    ->label('Batch Section / Subgroup')
                    ->placeholder('e.g. A, B, C')
                    ->helperText('Class section/subgroup (A, B, C etc.)')
                    ->maxLength(10),

                TextInput::make('program_study')
                    ->label('Study Program')
                    ->placeholder('e.g. D4 Fixed-Wing Commercial Pilot')
                    ->datalist([
                        'D4 Fixed-Wing Commercial Pilot',
                        'D3 Rotary-Wing Helicopter Pilot',
                        'D3 Flight Operations',
                        'Non-Diploma Commercial Pilot',
                    ]),

                Select::make('modulPenerbangan')
                    ->label('Flight Training Modules (Select 1 or more)')
                    ->relationship(
                        name: 'modulPenerbangan',
                        titleAttribute: 'nama_modul',
                        modifyQueryUsing: fn ($query) => $query->where('is_active', true)->orderBy('lisensi_target')->orderBy('kode_modul')
                    )
                    ->getOptionLabelFromRecordUsing(fn (ModulPenerbangan $record) => "[{$record->lisensi_target}] {$record->nama_modul}" . ($record->kode_modul ? " ({$record->kode_modul})" : ""))
                    ->multiple()
                    ->preload()
                    ->searchable()
                    ->placeholder('-- Select One or More Flight Modules --')
                    ->helperText('Select syllabus training modules assigned to this student')
                    ->columnSpanFull(),

                TextInput::make('total_jam_terbang')
                    ->label('Initial Flight Hours')
                    ->numeric()
                    ->default(0.0)
                    ->helperText('Initial accumulated flight hours (default: 0.0)'),

                Select::make('status')
                    ->label('Enrollment Status')
                    ->options([
                        'active' => 'Active',
                        'leave' => 'On Leave',
                        'graduated' => 'Graduated',
                        'inactive' => 'Inactive',
                        'aktif' => 'Active',
                        'cuti' => 'On Leave',
                        'lulus' => 'Graduated',
                        'nonaktif' => 'Inactive',
                    ])
                    ->default('active')
                    ->required(),

                Textarea::make('catatan')
                    ->label('Notes / Remarks')
                    ->placeholder('Special instructions, medical limitations, or academic notes')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}

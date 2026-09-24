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
                    ->label('Akun Pengguna (User)')
                    ->relationship('user', 'name')
                    ->getOptionLabelFromRecordUsing(fn (User $record) => "{$record->name} ({$record->email})")
                    ->searchable()
                    ->preload()
                    ->required()
                    ->helperText('Akun login yang terhubung dengan taruna ini'),

                TextInput::make('nim')
                    ->label('NIM (Nomor Induk Mahasiswa)')
                    ->placeholder('Contoh: TRN-2024-001')
                    ->unique(ignoreRecord: true)
                    ->required(),

                TextInput::make('nama')
                    ->label('Nama Lengkap')
                    ->placeholder('Nama lengkap taruna')
                    ->required(),

                TextInput::make('no_telepon')
                    ->label('Nomor Telepon / WhatsApp')
                    ->tel()
                    ->placeholder('Contoh: 081234567890')
                    ->default(null),

                TextInput::make('angkatan')
                    ->label('Angkatan')
                    ->placeholder('Contoh: 2024')
                    ->default(fn () => date('Y')),

                TextInput::make('batch')
                    ->label('Batch')
                    ->numeric()
                    ->placeholder('Contoh: 1, 2, 3')
                    ->helperText('Nomor rombongan belajar/batch (1, 2, 3 dst)'),

                TextInput::make('status_batch')
                    ->label('Status Batch')
                    ->placeholder('Contoh: A, B, C')
                    ->helperText('Status kelas batch (A, B, C dst)')
                    ->maxLength(10),

                TextInput::make('program_study')
                    ->label('Program Study')
                    ->placeholder('Contoh: D4 Penerbang Sayap Tetap')
                    ->datalist([
                        'D4 Penerbang Sayap Tetap',
                        'D3 Operasi Pesawat Udara',
                        'D3 Penerbang Sayap Putar',
                        'Non-Diploma Penerbang',
                    ]),

                Select::make('modulPenerbangan')
                    ->label('Modul Penerbangan (1 Siswa dapat 1 atau lebih)')
                    ->relationship(
                        name: 'modulPenerbangan',
                        titleAttribute: 'nama_modul',
                        modifyQueryUsing: fn ($query) => $query->where('is_active', true)->orderBy('lisensi_target')->orderBy('kode_modul')
                    )
                    ->getOptionLabelFromRecordUsing(fn (ModulPenerbangan $record) => "[{$record->lisensi_target}] {$record->nama_modul}" . ($record->kode_modul ? " ({$record->kode_modul})" : ""))
                    ->multiple()
                    ->preload()
                    ->searchable()
                    ->placeholder('-- Pilih 1 atau Lebih Modul Penerbangan --')
                    ->helperText('Pilih satu atau lebih modul silabus pelatihan terbang yang diikuti taruna')
                    ->columnSpanFull(),

                TextInput::make('total_jam_terbang')
                    ->label('Total Jam Terbang (Awal)')
                    ->numeric()
                    ->default(0.0)
                    ->helperText('Jam terbang awal taruna jika ada (default 0.0)'),

                Select::make('status')
                    ->label('Status Keaktifan')
                    ->options([
                        'aktif' => 'Aktif',
                        'cuti' => 'Cuti',
                        'lulus' => 'Lulus',
                        'nonaktif' => 'Nonaktif',
                    ])
                    ->default('aktif')
                    ->required(),

                Textarea::make('catatan')
                    ->label('Catatan Taruna')
                    ->placeholder('Catatan riwayat, instruksi pelatihan khusus, atau informasi lainnya')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}

<?php

namespace App\Filament\Resources\PengajuanReschedule\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Schema;

class PengajuanRescheduleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('kode_pengajuan')
                    ->required(),
                Select::make('jadwal_penerbangan_id')
                    ->relationship('jadwalPenerbangan', 'kode_jadwal')
                    ->required(),
                Select::make('pemohon_id')
                    ->relationship('pemohon', 'name')
                    ->required(),
                Select::make('tipe_pemohon')
                    ->options(['taruna' => 'Taruna', 'instruktur' => 'Instruktur'])
                    ->required(),
                DatePicker::make('tanggal_awal')
                    ->required(),
                TimePicker::make('jam_mulai_awal')
                    ->required(),
                TimePicker::make('jam_selesai_awal')
                    ->required(),
                DatePicker::make('tanggal_pengganti')
                    ->required(),
                TimePicker::make('jam_mulai_pengganti')
                    ->required(),
                TimePicker::make('jam_selesai_pengganti')
                    ->required(),
                Select::make('instruktur_pengganti_id')
                    ->relationship('instrukturPengganti', 'nama')
                    ->default(null),
                Select::make('pesawat_pengganti_id')
                    ->relationship('pesawatPengganti', 'nomor_registrasi')
                    ->default(null),
                Select::make('alasan_kategori')
                    ->options([
            'medis' => 'Medis',
            'cuaca_buruk' => 'Cuaca buruk',
            'teknis_pesawat' => 'Teknis pesawat',
            'keperluan_mendesak' => 'Keperluan mendesak',
            'lainnya' => 'Lainnya',
        ])
                    ->required(),
                Textarea::make('alasan_detail')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('dokumen_pendukung')
                    ->default(null),
                Select::make('status')
                    ->options(['pending' => 'Pending', 'approved' => 'Approved', 'rejected' => 'Rejected'])
                    ->default('pending')
                    ->required(),
                Textarea::make('catatan_admin')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('diproses_oleh')
                    ->numeric()
                    ->default(null),
                DateTimePicker::make('diproses_pada'),
            ]);
    }
}


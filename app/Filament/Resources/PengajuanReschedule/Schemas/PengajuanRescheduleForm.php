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
                    ->label('Request Code')
                    ->required(),
                Select::make('jadwal_penerbangan_id')
                    ->label('Flight Schedule')
                    ->relationship('jadwalPenerbangan', 'kode_jadwal')
                    ->required(),
                Select::make('pemohon_id')
                    ->label('Applicant')
                    ->relationship('pemohon', 'name')
                    ->required(),
                Select::make('tipe_pemohon')
                    ->label('Applicant Type')
                    ->options([
                        'taruna' => 'Student / Cadet',
                        'instruktur' => 'Flight Instructor',
                    ])
                    ->required(),
                DatePicker::make('tanggal_awal')
                    ->label('Original Date')
                    ->required(),
                TimePicker::make('jam_mulai_awal')
                    ->label('Original Start Time')
                    ->required(),
                TimePicker::make('jam_selesai_awal')
                    ->label('Original End Time')
                    ->required(),
                DatePicker::make('tanggal_pengganti')
                    ->label('Requested Replacement Date')
                    ->required(),
                TimePicker::make('jam_mulai_pengganti')
                    ->label('Requested Start Time')
                    ->required(),
                TimePicker::make('jam_selesai_pengganti')
                    ->label('Requested End Time')
                    ->required(),
                Select::make('instruktur_pengganti_id')
                    ->label('Substitute Instructor')
                    ->relationship('instrukturPengganti', 'nama')
                    ->default(null),
                Select::make('pesawat_pengganti_id')
                    ->label('Substitute Aircraft')
                    ->relationship('pesawatPengganti', 'nomor_registrasi')
                    ->default(null),
                Select::make('alasan_kategori')
                    ->label('Reason Category')
                    ->options([
                        'medis' => 'Medical',
                        'cuaca_buruk' => 'Bad Weather',
                        'teknis_pesawat' => 'Aircraft Technical Issue',
                        'keperluan_mendesak' => 'Urgent Matter',
                        'lainnya' => 'Other',
                    ])
                    ->required(),
                Textarea::make('alasan_detail')
                    ->label('Detailed Reason')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('dokumen_pendukung')
                    ->label('Supporting Document')
                    ->default(null),
                Select::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ])
                    ->default('pending')
                    ->required(),
                Textarea::make('catatan_admin')
                    ->label('Admin Notes')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('diproses_oleh')
                    ->label('Processed By (User ID)')
                    ->numeric()
                    ->default(null),
                DateTimePicker::make('diproses_pada')
                    ->label('Processed At'),
            ]);
    }
}


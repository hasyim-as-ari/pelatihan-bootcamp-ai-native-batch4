<?php

namespace App\Filament\Resources\PengajuanReschedule\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PengajuanRescheduleInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('kode_pengajuan')
                    ->label('Request Code'),
                TextEntry::make('jadwalPenerbangan.kode_jadwal')
                    ->label('Flight Schedule'),
                TextEntry::make('pemohon.name')
                    ->label('Applicant'),
                TextEntry::make('tipe_pemohon')
                    ->label('Applicant Type')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'taruna' => 'Student / Cadet',
                        'instruktur' => 'Flight Instructor',
                        default => ucfirst($state),
                    }),
                TextEntry::make('tanggal_awal')
                    ->label('Original Date')
                    ->date(),
                TextEntry::make('jam_mulai_awal')
                    ->label('Original Start Time')
                    ->time(),
                TextEntry::make('jam_selesai_awal')
                    ->label('Original End Time')
                    ->time(),
                TextEntry::make('tanggal_pengganti')
                    ->label('Requested Replacement Date')
                    ->date(),
                TextEntry::make('jam_mulai_pengganti')
                    ->label('Requested Start Time')
                    ->time(),
                TextEntry::make('jam_selesai_pengganti')
                    ->label('Requested End Time')
                    ->time(),
                TextEntry::make('instrukturPengganti.nama')
                    ->label('Substitute Instructor')
                    ->placeholder('-'),
                TextEntry::make('pesawatPengganti.nomor_registrasi')
                    ->label('Substitute Aircraft')
                    ->placeholder('-'),
                TextEntry::make('alasan_kategori')
                    ->label('Reason Category')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'medis' => 'Medical',
                        'cuaca_buruk' => 'Bad Weather',
                        'teknis_pesawat' => 'Aircraft Technical Issue',
                        'keperluan_mendesak' => 'Urgent Matter',
                        'lainnya' => 'Other',
                        default => ucfirst(str_replace('_', ' ', $state)),
                    }),
                TextEntry::make('alasan_detail')
                    ->label('Detailed Reason')
                    ->columnSpanFull(),
                TextEntry::make('dokumen_pendukung')
                    ->label('Supporting Document')
                    ->placeholder('-'),
                TextEntry::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending', 'menunggu' => 'Pending',
                        'approved', 'disetujui' => 'Approved',
                        'rejected', 'ditolak' => 'Rejected',
                        default => ucfirst($state),
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'pending', 'menunggu' => 'warning',
                        'approved', 'disetujui' => 'success',
                        'rejected', 'ditolak' => 'danger',
                        default => 'gray',
                    }),
                TextEntry::make('catatan_admin')
                    ->label('Admin Notes')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('diproses_oleh')
                    ->label('Processed By')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('diproses_pada')
                    ->label('Processed At')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->label('Submitted At')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->label('Updated At')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}



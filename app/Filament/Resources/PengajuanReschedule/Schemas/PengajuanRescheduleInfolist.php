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
                TextEntry::make('kode_pengajuan'),
                TextEntry::make('jadwalPenerbangan.kode_jadwal')
                    ->label('Jadwal penerbangan'),
                TextEntry::make('pemohon.name')
                    ->label('Pemohon'),
                TextEntry::make('tipe_pemohon')
                    ->badge(),
                TextEntry::make('tanggal_awal')
                    ->date(),
                TextEntry::make('jam_mulai_awal')
                    ->time(),
                TextEntry::make('jam_selesai_awal')
                    ->time(),
                TextEntry::make('tanggal_pengganti')
                    ->date(),
                TextEntry::make('jam_mulai_pengganti')
                    ->time(),
                TextEntry::make('jam_selesai_pengganti')
                    ->time(),
                TextEntry::make('instrukturPengganti.nama')
                    ->label('Instruktur pengganti')
                    ->placeholder('-'),
                TextEntry::make('pesawatPengganti.nomor_registrasi')
                    ->label('Pesawat pengganti')
                    ->placeholder('-'),
                TextEntry::make('alasan_kategori')
                    ->badge(),
                TextEntry::make('alasan_detail')
                    ->columnSpanFull(),
                TextEntry::make('dokumen_pendukung')
                    ->placeholder('-'),
                TextEntry::make('status')
                    ->badge(),
                TextEntry::make('catatan_admin')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('diproses_oleh')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('diproses_pada')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}



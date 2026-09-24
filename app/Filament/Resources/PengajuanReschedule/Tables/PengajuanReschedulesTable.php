<?php

namespace App\Filament\Resources\PengajuanReschedule\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PengajuanReschedulesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode_pengajuan')
                    ->searchable(),
                TextColumn::make('jadwalPenerbangan.kode_jadwal')
                    ->label('Jadwal Penerbangan')
                    ->searchable(),
                TextColumn::make('pemohon.name')
                    ->searchable(),
                TextColumn::make('tipe_pemohon')
                    ->badge(),
                TextColumn::make('tanggal_awal')
                    ->date()
                    ->sortable(),
                TextColumn::make('jam_mulai_awal')
                    ->time()
                    ->sortable(),
                TextColumn::make('jam_selesai_awal')
                    ->time()
                    ->sortable(),
                TextColumn::make('tanggal_pengganti')
                    ->date()
                    ->sortable(),
                TextColumn::make('jam_mulai_pengganti')
                    ->time()
                    ->sortable(),
                TextColumn::make('jam_selesai_pengganti')
                    ->time()
                    ->sortable(),
                TextColumn::make('instrukturPengganti.nama')
                    ->label('Instruktur Pengganti')
                    ->searchable(),
                TextColumn::make('pesawatPengganti.nomor_registrasi')
                    ->label('Pesawat Pengganti')
                    ->searchable(),
                TextColumn::make('alasan_kategori')
                    ->badge(),
                TextColumn::make('dokumen_pendukung')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge(),
                TextColumn::make('diproses_oleh')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('diproses_pada')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}


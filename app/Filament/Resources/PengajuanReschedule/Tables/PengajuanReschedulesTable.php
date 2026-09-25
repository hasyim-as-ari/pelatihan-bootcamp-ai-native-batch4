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
                    ->label('Request Code')
                    ->searchable(),
                TextColumn::make('jadwalPenerbangan.kode_jadwal')
                    ->label('Flight Schedule')
                    ->searchable(),
                TextColumn::make('pemohon.name')
                    ->label('Applicant')
                    ->searchable(),
                TextColumn::make('tipe_pemohon')
                    ->label('Applicant Type')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'taruna' => 'Student / Cadet',
                        'instruktur' => 'Instructor',
                        default => ucfirst($state),
                    }),
                TextColumn::make('tanggal_awal')
                    ->label('Original Date')
                    ->date()
                    ->sortable(),
                TextColumn::make('jam_mulai_awal')
                    ->label('Original Start Time')
                    ->time()
                    ->sortable(),
                TextColumn::make('jam_selesai_awal')
                    ->label('Original End Time')
                    ->time()
                    ->sortable(),
                TextColumn::make('tanggal_pengganti')
                    ->label('Requested Date')
                    ->date()
                    ->sortable(),
                TextColumn::make('jam_mulai_pengganti')
                    ->label('Requested Start Time')
                    ->time()
                    ->sortable(),
                TextColumn::make('jam_selesai_pengganti')
                    ->label('Requested End Time')
                    ->time()
                    ->sortable(),
                TextColumn::make('instrukturPengganti.nama')
                    ->label('Substitute Instructor')
                    ->searchable(),
                TextColumn::make('pesawatPengganti.nomor_registrasi')
                    ->label('Substitute Aircraft')
                    ->searchable(),
                TextColumn::make('alasan_kategori')
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
                TextColumn::make('dokumen_pendukung')
                    ->label('Supporting Document')
                    ->searchable(),
                TextColumn::make('status')
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
                TextColumn::make('diproses_oleh')
                    ->label('Processed By')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('diproses_pada')
                    ->label('Processed At')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Submitted At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Updated At')
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


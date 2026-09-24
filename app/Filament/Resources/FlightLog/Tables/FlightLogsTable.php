<?php

namespace App\Filament\Resources\FlightLog\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FlightLogsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('jadwalPenerbangan.kode_jadwal')
                    ->label('Jadwal Penerbangan')
                    ->searchable(),
                TextColumn::make('taruna.nama')
                    ->label('Taruna')
                    ->searchable(),
                TextColumn::make('instruktur.nama')
                    ->label('Instruktur')
                    ->searchable(),
                TextColumn::make('pesawat.nomor_registrasi')
                    ->label('Pesawat')
                    ->searchable(),
                TextColumn::make('tanggal')
                    ->date()
                    ->sortable(),
                TextColumn::make('jam_takeoff')
                    ->time()
                    ->sortable(),
                TextColumn::make('jam_landing')
                    ->time()
                    ->sortable(),
                TextColumn::make('durasi_terbang')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge(),
                TextColumn::make('nilai')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('hasil_evaluasi')
                    ->badge(),
                TextColumn::make('kondisi_cuaca')
                    ->searchable(),
                TextColumn::make('recorded_by')
                    ->numeric()
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


<?php

namespace App\Filament\Resources\Pesawat\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PesawatsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nomor_registrasi')
                    ->searchable(),
                TextColumn::make('tipe_pesawat')
                    ->searchable(),
                TextColumn::make('nama_pesawat')
                    ->searchable(),
                TextColumn::make('total_jam_terbang')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('jam_terbang_sebelum_maintenance')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge(),
                TextColumn::make('tanggal_maintenance_terakhir')
                    ->date()
                    ->sortable(),
                TextColumn::make('tanggal_maintenance_berikutnya')
                    ->date()
                    ->sortable(),
                TextColumn::make('kapasitas_penumpang')
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


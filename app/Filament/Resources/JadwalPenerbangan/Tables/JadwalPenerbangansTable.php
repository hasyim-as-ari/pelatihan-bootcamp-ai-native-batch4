<?php

namespace App\Filament\Resources\JadwalPenerbangan\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class JadwalPenerbangansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode_jadwal')
                    ->searchable(),
                TextColumn::make('tanggal')
                    ->date()
                    ->sortable(),
                TextColumn::make('jam_mulai')
                    ->time()
                    ->sortable(),
                TextColumn::make('jam_selesai')
                    ->time()
                    ->sortable(),
                TextColumn::make('taruna.nama')
                    ->label('Taruna')
                    ->searchable(),
                TextColumn::make('instruktur.nama')
                    ->label('Instruktur')
                    ->searchable(),
                TextColumn::make('pesawat.nomor_registrasi')
                    ->label('Pesawat')
                    ->searchable(),
                TextColumn::make('rute_area_latihan')
                    ->searchable(),
                TextColumn::make('modul_penerbangan')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge(),
                TextColumn::make('created_by')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('approved_by')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('published_at')
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


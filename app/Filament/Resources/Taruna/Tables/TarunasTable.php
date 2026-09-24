<?php

namespace App\Filament\Resources\Taruna\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TarunasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->searchable(),
                TextColumn::make('nim')
                    ->searchable(),
                TextColumn::make('nama')
                    ->searchable(),
                TextColumn::make('no_telepon')
                    ->searchable(),
                TextColumn::make('angkatan')
                    ->searchable(),
                TextColumn::make('batch')
                    ->label('Batch')
                    ->numeric()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('status_batch')
                    ->label('Status Batch')
                    ->badge()
                    ->color('info')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('program_study')
                    ->label('Program Study')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('modulPenerbangan.kode_modul')
                    ->label('Modul Penerbangan')
                    ->badge()
                    ->color('primary')
                    ->separator(', ')
                    ->placeholder(fn ($record) => $record->modul_penerbangan ?: '-')
                    ->searchable(),
                TextColumn::make('total_jam_terbang')
                    ->label('Total Jam')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('kuota_jam_terbang')
                    ->label('Kuota Jam')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('sisa_kuota_jam_terbang')
                    ->label('Sisa Kuota')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('max_jam_terbang_harian')
                    ->label('Max Harian')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('status')
                    ->badge(),
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


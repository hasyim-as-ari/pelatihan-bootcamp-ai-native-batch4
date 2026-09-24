<?php

namespace App\Filament\Resources\RuteAreaLatihan\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RuteAreaLatihansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode_rute')
                    ->label('Kode')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('nama_rute')
                    ->label('Nama Rute / Area')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('kategori')
                    ->label('Kategori')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Area Latihan Lokal' => 'info',
                        'Sirkuit Lokal' => 'success',
                        'Navigasi Cross Country' => 'warning',
                        default => 'gray',
                    })
                    ->searchable()
                    ->sortable(),
                TextColumn::make('estimasi_durasi_jam')
                    ->label('Durasi (Jam)')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
                TextColumn::make('created_at')
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

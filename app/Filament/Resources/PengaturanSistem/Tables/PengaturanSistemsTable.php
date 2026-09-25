<?php

namespace App\Filament\Resources\PengaturanSistem\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PengaturanSistemsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kunci')
                    ->label('Setting Key')
                    ->weight('bold')
                    ->searchable(),
                TextColumn::make('tipe_data')
                    ->label('Data Type')
                    ->badge()
                    ->searchable(),
                TextColumn::make('grup')
                    ->label('Group')
                    ->badge()
                    ->color('primary')
                    ->searchable(),
                TextColumn::make('deskripsi')
                    ->label('Description')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Created At')
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


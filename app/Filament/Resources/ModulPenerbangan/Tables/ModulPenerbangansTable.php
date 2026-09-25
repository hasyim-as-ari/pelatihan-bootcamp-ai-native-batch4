<?php

namespace App\Filament\Resources\ModulPenerbangan\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ModulPenerbangansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode_modul')
                    ->label('Module Code')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('nama_modul')
                    ->label('Module Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('lisensi_target')
                    ->label('License Target')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'PPL' => 'info',
                        'CPL' => 'success',
                        'IR' => 'warning',
                        'MER' => 'danger',
                        default => 'gray',
                    })
                    ->searchable()
                    ->sortable(),
                TextColumn::make('kategori')
                    ->label('Category')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('standar_jam_terbang')
                    ->label('Standard Flight Hours')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->label('Created At')
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

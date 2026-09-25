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
                    ->label('Route Code')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('nama_rute')
                    ->label('Route / Training Area Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('kategori')
                    ->label('Category')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'Area Latihan Lokal' => 'Local Training Area',
                        'Sirkuit Lokal' => 'Local Circuit',
                        'Navigasi Cross Country' => 'Cross Country Navigation',
                        default => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'Area Latihan Lokal', 'Local Training Area' => 'info',
                        'Sirkuit Lokal', 'Local Circuit' => 'success',
                        'Navigasi Cross Country', 'Cross Country Navigation' => 'warning',
                        default => 'gray',
                    })
                    ->searchable()
                    ->sortable(),
                TextColumn::make('estimasi_durasi_jam')
                    ->label('Estimated Duration (Hours)')
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

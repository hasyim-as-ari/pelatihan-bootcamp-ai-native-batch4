<?php

namespace App\Filament\Resources\Pesawat\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PesawatsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nomor_registrasi')
                    ->label('Tail Number')
                    ->weight('bold')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('tipe_pesawat')
                    ->label('Aircraft Model')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('nama_pesawat')
                    ->label('Callsign / Name')
                    ->placeholder('-')
                    ->searchable(),

                TextColumn::make('status')
                    ->label('Fleet Status')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'available' => 'Available',
                        'in_use' => 'In Flight',
                        'maintenance' => 'Maintenance',
                        'grounded' => 'Grounded',
                        default => ucfirst($state),
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'available' => 'success',
                        'in_use' => 'primary',
                        'maintenance' => 'warning',
                        'grounded' => 'danger',
                        default => 'gray',
                    }),

                TextColumn::make('total_jam_terbang')
                    ->label('Total Airframe (Hrs)')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('jam_terbang_sebelum_maintenance')
                    ->label('Hrs to Maint.')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('tanggal_maintenance_berikutnya')
                    ->label('Next Maint. Date')
                    ->date()
                    ->sortable(),

                TextColumn::make('kapasitas_penumpang')
                    ->label('Capacity')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->label('Added At')
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
                SelectFilter::make('status')
                    ->label('Fleet Status')
                    ->options([
                        'available' => 'Available',
                        'in_use' => 'In Flight',
                        'maintenance' => 'Maintenance',
                        'grounded' => 'Grounded',
                    ]),
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

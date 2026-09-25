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
                    ->label('Flight Schedule')
                    ->searchable(),
                TextColumn::make('taruna.nama')
                    ->label('Student / Cadet')
                    ->searchable(),
                TextColumn::make('instruktur.nama')
                    ->label('Instructor')
                    ->searchable(),
                TextColumn::make('pesawat.nomor_registrasi')
                    ->label('Aircraft')
                    ->searchable(),
                TextColumn::make('tanggal')
                    ->label('Date')
                    ->date()
                    ->sortable(),
                TextColumn::make('jam_takeoff')
                    ->label('Takeoff Time')
                    ->time()
                    ->sortable(),
                TextColumn::make('jam_landing')
                    ->label('Landing Time')
                    ->time()
                    ->sortable(),
                TextColumn::make('durasi_terbang')
                    ->label('Duration (Hours)')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge(),
                TextColumn::make('nilai')
                    ->label('Score')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('hasil_evaluasi')
                    ->label('Evaluation Result')
                    ->badge()
                    ->formatStateUsing(fn (?string $state): ?string => match ($state) {
                        'lulus' => 'Pass',
                        'tidak_lulus' => 'Fail',
                        'perlu_pengulangan' => 'Retake Required',
                        default => $state ? ucfirst(str_replace('_', ' ', $state)) : null,
                    })
                    ->color(fn (?string $state): string => match ($state) {
                        'lulus' => 'success',
                        'tidak_lulus' => 'danger',
                        'perlu_pengulangan' => 'warning',
                        default => 'gray',
                    }),
                TextColumn::make('kondisi_cuaca')
                    ->label('Weather Condition')
                    ->searchable(),
                TextColumn::make('recorded_by')
                    ->label('Recorded By')
                    ->numeric()
                    ->sortable(),
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


<?php

namespace App\Filament\Resources\Taruna\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class TarunasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nim')
                    ->label('Student ID (NIM)')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('nama')
                    ->label('Full Name')
                    ->weight('bold')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('user.email')
                    ->label('Email Account')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('no_telepon')
                    ->label('Phone Number')
                    ->searchable(),

                TextColumn::make('batch')
                    ->label('Batch')
                    ->numeric()
                    ->sortable()
                    ->searchable(),

                TextColumn::make('status_batch')
                    ->label('Section')
                    ->badge()
                    ->color('info')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('program_study')
                    ->label('Study Program')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('modulPenerbangan.kode_modul')
                    ->label('Flight Module')
                    ->badge()
                    ->color('primary')
                    ->separator(', ')
                    ->placeholder(fn ($record) => $record->modul_penerbangan ?: '-')
                    ->searchable(),

                TextColumn::make('total_jam_terbang')
                    ->label('Total Hours')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('kuota_jam_terbang')
                    ->label('Quota Hours')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('sisa_kuota_jam_terbang')
                    ->label('Remaining Quota')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('max_jam_terbang_harian')
                    ->label('Max Daily')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'active', 'aktif' => 'Active',
                        'leave', 'cuti' => 'On Leave',
                        'graduated', 'lulus' => 'Graduated',
                        'inactive', 'nonaktif' => 'Inactive',
                        default => ucfirst($state),
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'active', 'aktif' => 'success',
                        'leave', 'cuti' => 'warning',
                        'graduated', 'lulus' => 'info',
                        'inactive', 'nonaktif' => 'danger',
                        default => 'gray',
                    }),

                TextColumn::make('created_at')
                    ->label('Registered At')
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
                    ->label('Status')
                    ->options([
                        'active' => 'Active',
                        'leave' => 'On Leave',
                        'graduated' => 'Graduated',
                        'inactive' => 'Inactive',
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

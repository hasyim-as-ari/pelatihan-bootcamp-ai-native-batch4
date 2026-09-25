<?php

namespace App\Filament\Resources\Instruktur\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class InstruktursTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')
                    ->label('Instructor Name')
                    ->weight('bold')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('nidn')
                    ->label('ID / License No.')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('user.name')
                    ->label('User Account')
                    ->description(fn ($record) => $record->user?->email)
                    ->searchable(),

                TextColumn::make('no_telepon')
                    ->label('Phone Number')
                    ->searchable(),

                TextColumn::make('lisensi')
                    ->label('License')
                    ->badge()
                    ->color('primary')
                    ->searchable(),

                TextColumn::make('max_jam_terbang_harian')
                    ->label('Max Daily (Hrs)')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('total_jam_terbang')
                    ->label('Total Hours')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'active', 'aktif' => 'Active',
                        'leave', 'cuti' => 'On Leave',
                        'inactive', 'nonaktif' => 'Inactive',
                        default => ucfirst($state),
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'active', 'aktif' => 'success',
                        'leave', 'cuti' => 'warning',
                        'inactive', 'nonaktif' => 'danger',
                        default => 'gray',
                    }),

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
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'active' => 'Active',
                        'leave' => 'On Leave',
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

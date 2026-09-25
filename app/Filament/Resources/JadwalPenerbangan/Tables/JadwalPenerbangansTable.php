<?php

namespace App\Filament\Resources\JadwalPenerbangan\Tables;

use App\Models\Taruna;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class JadwalPenerbangansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode_jadwal')
                    ->label('Schedule Code')
                    ->weight('bold')
                    ->copyable()
                    ->searchable()
                    ->sortable(),

                TextColumn::make('tanggal')
                    ->label('Flight Date')
                    ->date('M d, Y')
                    ->sortable(),

                TextColumn::make('jam_mulai')
                    ->label('Time Window')
                    ->formatStateUsing(function ($record) {
                        $start = substr($record->jam_mulai, 0, 5);
                        $end = substr($record->jam_selesai, 0, 5);
                        return "{$start} - {$end}";
                    })
                    ->icon('heroicon-m-clock')
                    ->sortable(),

                TextColumn::make('taruna.nama')
                    ->label('Student / Cadet')
                    ->description(fn ($record) => $record->taruna?->batch ? 'Batch ' . $record->taruna->batch . ($record->taruna->nim ? ' • ID: ' . $record->taruna->nim : '') : null)
                    ->weight('semibold')
                    ->searchable(),

                TextColumn::make('instruktur.nama')
                    ->label('Flight Instructor')
                    ->searchable(),

                TextColumn::make('pesawat.nomor_registrasi')
                    ->label('Aircraft (Tail No.)')
                    ->badge()
                    ->color('gray')
                    ->searchable(),

                TextColumn::make('rute_area_latihan')
                    ->label('Training Route / Area')
                    ->placeholder('-')
                    ->searchable(),

                TextColumn::make('modul_penerbangan')
                    ->label('Module')
                    ->badge()
                    ->color('primary')
                    ->placeholder('-')
                    ->searchable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'draft' => 'Draft',
                        'scheduled' => 'Scheduled',
                        'in_flight' => 'In Flight',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                        'rescheduled' => 'Rescheduled',
                        default => ucfirst($state),
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'draft' => 'gray',
                        'scheduled' => 'info',
                        'in_flight' => 'warning',
                        'completed' => 'success',
                        'cancelled' => 'danger',
                        'rescheduled' => 'primary',
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
                SelectFilter::make('batch')
                    ->label('SELECT BATCH')
                    ->placeholder('SELECT BATCH')
                    ->options(fn () => Taruna::whereNotNull('batch')
                        ->distinct()
                        ->orderBy('batch')
                        ->pluck('batch', 'batch')
                        ->toArray()
                    )
                    ->query(function (Builder $query, array $data) {
                        if (filled($data['value'] ?? null)) {
                            $query->whereHas('taruna', fn (Builder $q) => $q->where('batch', $data['value']));
                        }
                    })
                    ->searchable()
                    ->preload(),

                SelectFilter::make('taruna_id')
                    ->label('SELECT STUDENT')
                    ->placeholder('SELECT STUDENT')
                    ->options(function ($livewire) {
                        $selectedBatch = $livewire->tableFilters['batch']['value'] ?? null;
                        $query = Taruna::query()->orderBy('nama');
                        if (filled($selectedBatch)) {
                            $query->where('batch', $selectedBatch);
                        }
                        return $query->get()->mapWithKeys(fn (Taruna $t) => [
                            $t->id => $t->nama . ($t->batch ? " (Batch {$t->batch})" : ""),
                        ])->toArray();
                    })
                    ->query(function (Builder $query, array $data) {
                        if (filled($data['value'] ?? null)) {
                            $query->where('taruna_id', $data['value']);
                        }
                    })
                    ->searchable()
                    ->preload(),

                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'scheduled' => 'Scheduled',
                        'in_flight' => 'In Flight',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                        'rescheduled' => 'Rescheduled',
                        'draft' => 'Draft',
                    ]),
            ])
            ->filtersLayout(FiltersLayout::AboveContent)
            ->deferFilters()
            ->filtersFormColumns(['sm' => 1, 'md' => 3, 'lg' => 3])
            ->filtersApplyAction(
                fn (Action $action) => $action
                    ->label('FILTER')
                    ->button()
                    ->color('primary')
            )
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

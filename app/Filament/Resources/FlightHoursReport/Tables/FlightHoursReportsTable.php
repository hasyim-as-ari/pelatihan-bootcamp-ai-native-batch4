<?php

namespace App\Filament\Resources\FlightHoursReport\Tables;

use App\Models\Taruna;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;

class FlightHoursReportsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('tanggal', 'desc')
            ->columns([
                TextColumn::make('kode_jadwal')
                    ->label('Schedule Code')
                    ->badge()
                    ->color('primary')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('tanggal')
                    ->label('Flight Date')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('taruna.nama')
                    ->label('Student')
                    ->weight('semibold')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('taruna.nim')
                    ->label('NIM')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('taruna.batch')
                    ->label('Batch')
                    ->badge()
                    ->color('info')
                    ->sortable(),

                TextColumn::make('taruna.program_study')
                    ->label('Study Program')
                    ->limit(30)
                    ->toggleable(isToggledHiddenByDefault: false),

                TextColumn::make('instruktur.nama')
                    ->label('Instructor')
                    ->searchable(),

                TextColumn::make('pesawat.nomor_registrasi')
                    ->label('Aircraft')
                    ->badge()
                    ->color('gray'),

                TextColumn::make('modul_penerbangan')
                    ->label('Module')
                    ->badge()
                    ->color('primary')
                    ->placeholder('-'),

                TextColumn::make('jam_mulai')
                    ->label('Start')
                    ->formatStateUsing(fn ($state) => $state ? substr($state, 0, 5) : '-')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('jam_selesai')
                    ->label('End')
                    ->formatStateUsing(fn ($state) => $state ? substr($state, 0, 5) : '-')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('flightLog.durasi_terbang')
                    ->label('Flight Hours')
                    ->formatStateUsing(fn ($state) => $state ? number_format($state, 2) . ' hrs' : '-')
                    ->badge()
                    ->color('success')
                    ->sortable(),

                TextColumn::make('flightLog.nilai')
                    ->label('Score')
                    ->placeholder('-')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('flightLog.hasil_evaluasi')
                    ->label('Evaluation')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'lulus'              => 'success',
                        'tidak_lulus'        => 'danger',
                        'perlu_pengulangan'  => 'warning',
                        default              => 'gray',
                    })
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'lulus'              => 'Passed',
                        'tidak_lulus'        => 'Failed',
                        'perlu_pengulangan'  => 'Repeat Required',
                        default              => '-',
                    })
                    ->toggleable(isToggledHiddenByDefault: false),

                TextColumn::make('rute_area_latihan')
                    ->label('Route / Area')
                    ->placeholder('-')
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
                    ->modifyFormFieldUsing(fn (Select $field) => $field
                        ->live()
                        ->afterStateUpdated(function ($state, $livewire) {
                            if (isset($livewire->tableDeferredFilters['taruna_id'])) {
                                $livewire->tableDeferredFilters['taruna_id']['value'] = null;
                            }
                            if (isset($livewire->tableFilters['taruna_id'])) {
                                $livewire->tableFilters['taruna_id']['value'] = null;
                            }
                        })
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
                    ->options(function ($livewire = null) {
                        $selectedBatch = null;
                        if ($livewire) {
                            $selectedBatch = $livewire->tableDeferredFilters['batch']['value']
                                ?? $livewire->tableFilters['batch']['value']
                                ?? null;
                        }
                        if (blank($selectedBatch)) {
                            return [];
                        }
                        return Taruna::where('batch', $selectedBatch)
                            ->orderBy('nama')
                            ->get()
                            ->mapWithKeys(fn (Taruna $t) => [
                                $t->id => $t->nama . ($t->nim ? " ({$t->nim})" : ''),
                            ])
                            ->toArray();
                    })
                    ->modifyFormFieldUsing(fn (Select $field) => $field
                        ->options(function ($livewire = null) {
                            $selectedBatch = null;
                            if ($livewire) {
                                $selectedBatch = $livewire->tableDeferredFilters['batch']['value']
                                    ?? $livewire->tableFilters['batch']['value']
                                    ?? null;
                            }
                            if (blank($selectedBatch)) {
                                return [];
                            }
                            return Taruna::where('batch', $selectedBatch)
                                ->orderBy('nama')
                                ->get()
                                ->mapWithKeys(fn (Taruna $t) => [
                                    $t->id => $t->nama . ($t->nim ? " ({$t->nim})" : ''),
                                ])
                                ->toArray();
                        })
                    )
                    ->query(function (Builder $query, array $data) {
                        if (filled($data['value'] ?? null)) {
                            $query->where('taruna_id', $data['value']);
                        }
                    })
                    ->searchable()
                    ->preload(),

                SelectFilter::make('modul_penerbangan')
                    ->label('MODULE')
                    ->options(fn () => \App\Models\JadwalPenerbangan::where('status', 'completed')
                        ->whereNotNull('modul_penerbangan')
                        ->distinct()
                        ->orderBy('modul_penerbangan')
                        ->pluck('modul_penerbangan', 'modul_penerbangan')
                        ->toArray()
                    ),
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
            ->headerActions([
                Action::make('export_excel')
                    ->label('Export Excel')
                    ->icon('heroicon-o-table-cells')
                    ->color('success')
                    ->url(function ($livewire) {
                        $filters  = $livewire->tableFilters ?? [];
                        $tarunaId = $filters['taruna_id']['value'] ?? null;
                        $batch    = $filters['batch']['value'] ?? null;
                        $modul    = $filters['modul_penerbangan']['value'] ?? null;
                        $params   = http_build_query(array_filter([
                            'taruna_id' => $tarunaId,
                            'batch'     => $batch,
                            'modul'     => $modul,
                        ]));
                        $url = route('flight-hours.export.excel');
                        return $params ? "{$url}?{$params}" : $url;
                    })
                    ->openUrlInNewTab(),

                Action::make('export_pdf')
                    ->label('Export PDF')
                    ->icon('heroicon-o-document-arrow-down')
                    ->color('danger')
                    ->url(function ($livewire) {
                        $filters  = $livewire->tableFilters ?? [];
                        $tarunaId = $filters['taruna_id']['value'] ?? null;
                        $batch    = $filters['batch']['value'] ?? null;
                        $modul    = $filters['modul_penerbangan']['value'] ?? null;
                        $params   = http_build_query(array_filter([
                            'taruna_id' => $tarunaId,
                            'batch'     => $batch,
                            'modul'     => $modul,
                        ]));
                        $url = route('flight-hours.export.pdf');
                        return $params ? "{$url}?{$params}" : $url;
                    })
                    ->openUrlInNewTab(),
            ])
            ->toolbarActions([]);
    }
}

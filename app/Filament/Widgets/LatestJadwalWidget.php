<?php

namespace App\Filament\Widgets;

use App\Models\JadwalPenerbangan;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestJadwalWidget extends BaseWidget
{
    protected static ?int $sort = 5;

    protected static ?string $heading = 'Recent Flight Schedules';

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                JadwalPenerbangan::query()
                    ->with(['taruna', 'instruktur', 'pesawat'])
                    ->latest('tanggal')
                    ->latest('jam_mulai')
            )
            ->columns([
                TextColumn::make('kode_jadwal')
                    ->label('Schedule Code')
                    ->weight('bold')
                    ->copyable()
                    ->searchable(),

                TextColumn::make('tanggal')
                    ->label('Date')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('jam_mulai')
                    ->label('Flight Time')
                    ->formatStateUsing(function ($record) {
                        $start = substr($record->jam_mulai, 0, 5);
                        $end = substr($record->jam_selesai, 0, 5);
                        return "{$start} - {$end}";
                    })
                    ->icon('heroicon-m-clock'),

                TextColumn::make('taruna.nama')
                    ->label('Student / Cadet')
                    ->description(fn ($record) => $record->taruna?->nim ? 'NIM: ' . $record->taruna->nim : null)
                    ->searchable(),

                TextColumn::make('instruktur.nama')
                    ->label('Flight Instructor')
                    ->searchable(),

                TextColumn::make('pesawat.nomor_registrasi')
                    ->label('Aircraft')
                    ->description(fn ($record) => $record->pesawat?->tipe_pesawat)
                    ->badge()
                    ->color('gray'),

                TextColumn::make('modul_penerbangan')
                    ->label('Module')
                    ->badge()
                    ->color('primary')
                    ->placeholder('-'),

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
            ])
            ->paginated([5, 10]);
    }
}

<?php

namespace App\Filament\Resources\Taruna\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TarunaInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nama')
                    ->label('Full Name'),
                TextEntry::make('nim')
                    ->label('Student ID (NIM)'),
                TextEntry::make('user.name')
                    ->label('User Account'),
                TextEntry::make('no_telepon')
                    ->label('Phone Number')
                    ->placeholder('-'),
                TextEntry::make('angkatan')
                    ->label('Class Year / Intake')
                    ->placeholder('-'),
                TextEntry::make('batch')
                    ->label('Batch')
                    ->placeholder('-'),
                TextEntry::make('status_batch')
                    ->label('Section')
                    ->badge()
                    ->placeholder('-'),
                TextEntry::make('program_study')
                    ->label('Study Program')
                    ->placeholder('-'),
                TextEntry::make('modulPenerbangan.nama_modul')
                    ->label('Flight Modules')
                    ->badge()
                    ->separator(', ')
                    ->placeholder(fn ($record) => $record->modul_penerbangan ?: '-'),
                TextEntry::make('total_jam_terbang')
                    ->label('Total Flight Hours')
                    ->numeric(),
                TextEntry::make('kuota_jam_terbang')
                    ->label('Quota Flight Hours')
                    ->numeric(),
                TextEntry::make('sisa_kuota_jam_terbang')
                    ->label('Remaining Quota')
                    ->numeric(),
                TextEntry::make('max_jam_terbang_harian')
                    ->label('Max Daily Flight Hours')
                    ->numeric(),
                TextEntry::make('status')
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
                TextEntry::make('catatan')
                    ->label('Notes / Remarks')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->label('Registered At')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->label('Updated At')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}

<?php

namespace App\Filament\Resources\Instruktur\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class InstrukturInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nama')
                    ->label('Instructor Name'),
                TextEntry::make('nidn')
                    ->label('Instructor ID / License No.'),
                TextEntry::make('user.name')
                    ->label('User Account'),
                TextEntry::make('no_telepon')
                    ->label('Phone Number')
                    ->placeholder('-'),
                TextEntry::make('lisensi')
                    ->label('Pilot License')
                    ->placeholder('-'),
                TextEntry::make('max_jam_terbang_harian')
                    ->label('Max Daily Flight Hours (Hours)')
                    ->numeric(),
                TextEntry::make('total_jam_terbang')
                    ->label('Total Flight Hours (Hours)')
                    ->numeric(),
                TextEntry::make('status')
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
                TextEntry::make('catatan')
                    ->label('Notes / Remarks')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->label('Updated At')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}

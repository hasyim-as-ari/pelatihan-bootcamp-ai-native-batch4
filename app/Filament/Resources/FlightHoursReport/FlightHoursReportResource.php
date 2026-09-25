<?php

namespace App\Filament\Resources\FlightHoursReport;

use App\Filament\Resources\FlightHoursReport\Pages\ListFlightHoursReports;
use App\Filament\Resources\FlightHoursReport\Tables\FlightHoursReportsTable;
use App\Models\JadwalPenerbangan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class FlightHoursReportResource extends Resource
{
    protected static ?string $model = JadwalPenerbangan::class;

    protected static ?string $slug = 'flight-hours-reports';

    protected static ?string $modelLabel = 'Flight Hours Report';

    protected static ?string $pluralModelLabel = 'Flight Hours Reports';

    protected static ?string $navigationLabel = 'Flight Hours Reports';

    protected static string|\UnitEnum|null $navigationGroup = 'Reports & History';

    protected static ?int $navigationSort = 3;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-chart-bar';

    public static function canCreate(): bool { return false; }
    public static function canEdit($record): bool { return false; }
    public static function canDelete($record): bool { return false; }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()
            ->where('status', 'completed')
            ->with(['taruna', 'instruktur', 'pesawat', 'flightLog']);
    }

    public static function table(Table $table): Table
    {
        return FlightHoursReportsTable::configure($table);
    }

    public static function getRelations(): array { return []; }

    public static function getPages(): array
    {
        return [
            'index' => ListFlightHoursReports::route('/'),
        ];
    }
}

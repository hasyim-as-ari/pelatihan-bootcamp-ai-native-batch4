<?php

namespace App\Filament\Resources\FlightHoursReport;

use App\Filament\Resources\FlightHoursReport\Pages\ListFlightHoursReports;
use App\Filament\Resources\FlightHoursReport\Tables\FlightHoursReportsTable;
use App\Models\JadwalPenerbangan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

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

    public static function canViewAny(): bool
    {
        $user = auth()->user();

        return $user && $user->hasAnyRole(['super_admin', 'admin_operasional', 'taruna', 'pimpinan']);
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit($record): bool
    {
        return false;
    }

    public static function canDelete($record): bool
    {
        return false;
    }

    public static function getNavigationLabel(): string
    {
        $user = auth()->user();
        if ($user && $user->hasRole('taruna')) {
            return 'Training Progress / Reports';
        }

        return 'Flight Hours Reports';
    }

    public static function getNavigationGroup(): ?string
    {
        $user = auth()->user();
        if ($user && $user->hasRole('taruna')) {
            return null;
        }

        return 'Reports & History';
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery()
            ->where('status', 'completed')
            ->with(['taruna', 'instruktur', 'pesawat', 'flightLog']);

        $user = auth()->user();
        if ($user && $user->hasRole('taruna')) {
            $query->whereHas('taruna', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        }

        return $query;
    }

    public static function table(Table $table): Table
    {
        return FlightHoursReportsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFlightHoursReports::route('/'),
        ];
    }
}

<?php

namespace App\Filament\Resources\FlightLog;

use App\Filament\Resources\FlightLog\Pages\CreateFlightLog;
use App\Filament\Resources\FlightLog\Pages\EditFlightLog;
use App\Filament\Resources\FlightLog\Pages\ListFlightLogs;
use App\Filament\Resources\FlightLog\Pages\ViewFlightLog;
use App\Filament\Resources\FlightLog\Schemas\FlightLogForm;
use App\Filament\Resources\FlightLog\Schemas\FlightLogInfolist;
use App\Filament\Resources\FlightLog\Tables\FlightLogsTable;
use App\Models\FlightLog;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class FlightLogResource extends Resource
{
    protected static ?string $model = FlightLog::class;

    protected static ?string $pluralModelLabel = 'Flight Log';

    protected static string | \UnitEnum | null $navigationGroup = 'Operasional Penerbangan';
    protected static ?int $navigationSort = 2;
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-clipboard-document-check';

    public static function form(Schema $schema): Schema
    {
        return FlightLogForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return FlightLogInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FlightLogsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        $query = parent::getEloquentQuery();
        
        $user = auth()->user();
        
        if ($user->isSuperAdmin() || $user->isAdminOperasional() || $user->isPimpinan()) {
            return $query;
        }

        if ($user->isInstruktur()) {
            return $query->whereHas('instruktur', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        }

        if ($user->isTaruna()) {
            return $query->whereHas('taruna', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        }

        return $query;
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFlightLogs::route('/'),
            'create' => CreateFlightLog::route('/create'),
            'view' => ViewFlightLog::route('/{record}'),
            'edit' => EditFlightLog::route('/{record}/edit'),
        ];
    }
}




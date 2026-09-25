<?php
namespace App\Filament\Resources\AircraftDispatch;
use App\Filament\Resources\AircraftDispatch\Pages\CreateAircraftDispatch;
use App\Filament\Resources\AircraftDispatch\Pages\EditAircraftDispatch;
use App\Filament\Resources\AircraftDispatch\Pages\ListAircraftDispatches;
use App\Filament\Resources\AircraftDispatch\Pages\ViewAircraftDispatch;
use App\Filament\Resources\AircraftDispatch\Schemas\AircraftDispatchForm;
use App\Filament\Resources\AircraftDispatch\Tables\AircraftDispatchesTable;
use App\Models\AircraftDispatch;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
class AircraftDispatchResource extends Resource {
    protected static ?string $model = AircraftDispatch::class;
    protected static ?string $slug = 'aircraft-dispatches';
    protected static ?string $modelLabel = 'Aircraft Dispatch';
    protected static ?string $pluralModelLabel = 'Aircraft Check-In / Dispatch';
    protected static ?string $navigationLabel = 'Aircraft Check-In / Dispatch';
    protected static string|\UnitEnum|null $navigationGroup = 'Flight Operations';
    protected static ?int $navigationSort = 5;
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-paper-airplane';
    public static function form(Schema $schema): Schema { return AircraftDispatchForm::configure($schema); }
    public static function table(Table $table): Table { return AircraftDispatchesTable::configure($table); }
    public static function getRelations(): array { return []; }
    public static function getPages(): array {
        return [
            'index'  => ListAircraftDispatches::route('/'),
            'create' => CreateAircraftDispatch::route('/create'),
            'view'   => ViewAircraftDispatch::route('/{record}'),
            'edit'   => EditAircraftDispatch::route('/{record}/edit'),
        ];
    }
}

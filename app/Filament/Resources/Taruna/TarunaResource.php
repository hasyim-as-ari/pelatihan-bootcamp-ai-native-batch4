<?php

namespace App\Filament\Resources\Taruna;

use App\Filament\Resources\Taruna\Pages\CreateTaruna;
use App\Filament\Resources\Taruna\Pages\EditTaruna;
use App\Filament\Resources\Taruna\Pages\ListTarunas;
use App\Filament\Resources\Taruna\Pages\ViewTaruna;
use App\Filament\Resources\Taruna\Schemas\TarunaForm;
use App\Filament\Resources\Taruna\Schemas\TarunaInfolist;
use App\Filament\Resources\Taruna\Tables\TarunasTable;
use App\Models\Taruna;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TarunaResource extends Resource
{
    protected static ?string $model = Taruna::class;

    protected static ?string $pluralModelLabel = 'Taruna';

    protected static string | \UnitEnum | null $navigationGroup = 'Data Master';
    protected static ?int $navigationSort = 2;
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-users';

    public static function form(Schema $schema): Schema
    {
        return TarunaForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return TarunaInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TarunasTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTarunas::route('/'),
            'create' => CreateTaruna::route('/create'),
            'view' => ViewTaruna::route('/{record}'),
            'edit' => EditTaruna::route('/{record}/edit'),
        ];
    }
}




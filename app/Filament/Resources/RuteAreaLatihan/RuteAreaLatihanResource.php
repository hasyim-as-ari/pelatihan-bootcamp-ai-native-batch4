<?php

namespace App\Filament\Resources\RuteAreaLatihan;

use App\Filament\Resources\RuteAreaLatihan\Pages\CreateRuteAreaLatihan;
use App\Filament\Resources\RuteAreaLatihan\Pages\EditRuteAreaLatihan;
use App\Filament\Resources\RuteAreaLatihan\Pages\ListRuteAreaLatihans;
use App\Filament\Resources\RuteAreaLatihan\Pages\ViewRuteAreaLatihan;
use App\Filament\Resources\RuteAreaLatihan\Schemas\RuteAreaLatihanForm;
use App\Filament\Resources\RuteAreaLatihan\Schemas\RuteAreaLatihanInfolist;
use App\Filament\Resources\RuteAreaLatihan\Tables\RuteAreaLatihansTable;
use App\Models\RuteAreaLatihan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class RuteAreaLatihanResource extends Resource
{
    protected static ?string $model = RuteAreaLatihan::class;

    protected static ?string $pluralModelLabel = 'Rute Area Latihan';

    protected static string | \UnitEnum | null $navigationGroup = 'Data Master';
    protected static ?int $navigationSort = 5;
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-map-pin';

    public static function form(Schema $schema): Schema
    {
        return RuteAreaLatihanForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return RuteAreaLatihanInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RuteAreaLatihansTable::configure($table);
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
            'index' => ListRuteAreaLatihans::route('/'),
            'create' => CreateRuteAreaLatihan::route('/create'),
            'view' => ViewRuteAreaLatihan::route('/{record}'),
            'edit' => EditRuteAreaLatihan::route('/{record}/edit'),
        ];
    }
}

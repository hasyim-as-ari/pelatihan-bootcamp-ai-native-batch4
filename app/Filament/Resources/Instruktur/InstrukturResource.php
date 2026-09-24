<?php

namespace App\Filament\Resources\Instruktur;

use App\Filament\Resources\Instruktur\Pages\CreateInstruktur;
use App\Filament\Resources\Instruktur\Pages\EditInstruktur;
use App\Filament\Resources\Instruktur\Pages\ListInstrukturs;
use App\Filament\Resources\Instruktur\Pages\ViewInstruktur;
use App\Filament\Resources\Instruktur\Schemas\InstrukturForm;
use App\Filament\Resources\Instruktur\Schemas\InstrukturInfolist;
use App\Filament\Resources\Instruktur\Tables\InstruktursTable;
use App\Models\Instruktur;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class InstrukturResource extends Resource
{
    protected static ?string $model = Instruktur::class;

    protected static ?string $pluralModelLabel = 'Instruktur';

    protected static string | \UnitEnum | null $navigationGroup = 'Data Master';
    protected static ?int $navigationSort = 1;
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-academic-cap';

    public static function form(Schema $schema): Schema
    {
        return InstrukturForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return InstrukturInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return InstruktursTable::configure($table);
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
            'index' => ListInstrukturs::route('/'),
            'create' => CreateInstruktur::route('/create'),
            'view' => ViewInstruktur::route('/{record}'),
            'edit' => EditInstruktur::route('/{record}/edit'),
        ];
    }
}




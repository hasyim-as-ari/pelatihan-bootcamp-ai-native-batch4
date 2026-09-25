<?php

namespace App\Filament\Resources\Pesawat;

use App\Filament\Resources\Pesawat\Pages\CreatePesawat;
use App\Filament\Resources\Pesawat\Pages\EditPesawat;
use App\Filament\Resources\Pesawat\Pages\ListPesawats;
use App\Filament\Resources\Pesawat\Pages\ViewPesawat;
use App\Filament\Resources\Pesawat\Schemas\PesawatForm;
use App\Filament\Resources\Pesawat\Schemas\PesawatInfolist;
use App\Filament\Resources\Pesawat\Tables\PesawatsTable;
use App\Models\Pesawat;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PesawatResource extends Resource
{
    protected static ?string $model = Pesawat::class;

    protected static ?string $slug = 'aircraft';

    protected static ?string $modelLabel = 'Aircraft';

    protected static ?string $pluralModelLabel = 'Aircraft Fleet';

    protected static ?string $navigationLabel = 'Aircraft Fleet';

    protected static string | \UnitEnum | null $navigationGroup = 'Master Data';
    protected static ?int $navigationSort = 3;
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-paper-airplane';

    public static function form(Schema $schema): Schema
    {
        return PesawatForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PesawatInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PesawatsTable::configure($table);
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
            'index' => ListPesawats::route('/'),
            'create' => CreatePesawat::route('/create'),
            'view' => ViewPesawat::route('/{record}'),
            'edit' => EditPesawat::route('/{record}/edit'),
        ];
    }
}

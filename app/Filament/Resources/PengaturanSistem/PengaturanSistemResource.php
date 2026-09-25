<?php

namespace App\Filament\Resources\PengaturanSistem;

use App\Filament\Resources\PengaturanSistem\Pages\CreatePengaturanSistem;
use App\Filament\Resources\PengaturanSistem\Pages\EditPengaturanSistem;
use App\Filament\Resources\PengaturanSistem\Pages\ListPengaturanSistems;
use App\Filament\Resources\PengaturanSistem\Pages\ViewPengaturanSistem;
use App\Filament\Resources\PengaturanSistem\Schemas\PengaturanSistemForm;
use App\Filament\Resources\PengaturanSistem\Schemas\PengaturanSistemInfolist;
use App\Filament\Resources\PengaturanSistem\Tables\PengaturanSistemsTable;
use App\Models\PengaturanSistem;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PengaturanSistemResource extends Resource
{
    protected static ?string $model = PengaturanSistem::class;

    protected static ?string $slug = 'system-settings';

    protected static ?string $modelLabel = 'System Setting';

    protected static ?string $pluralModelLabel = 'System Settings';

    protected static ?string $navigationLabel = 'System Settings';

    protected static string | \UnitEnum | null $navigationGroup = 'Settings';
    protected static ?int $navigationSort = 2;
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-cog-6-tooth';

    public static function form(Schema $schema): Schema
    {
        return PengaturanSistemForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PengaturanSistemInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PengaturanSistemsTable::configure($table);
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
            'index' => ListPengaturanSistems::route('/'),
            'create' => CreatePengaturanSistem::route('/create'),
            'view' => ViewPengaturanSistem::route('/{record}'),
            'edit' => EditPengaturanSistem::route('/{record}/edit'),
        ];
    }
}




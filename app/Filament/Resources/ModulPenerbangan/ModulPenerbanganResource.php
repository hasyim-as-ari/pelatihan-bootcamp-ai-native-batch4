<?php

namespace App\Filament\Resources\ModulPenerbangan;

use App\Filament\Resources\ModulPenerbangan\Pages\CreateModulPenerbangan;
use App\Filament\Resources\ModulPenerbangan\Pages\EditModulPenerbangan;
use App\Filament\Resources\ModulPenerbangan\Pages\ListModulPenerbangans;
use App\Filament\Resources\ModulPenerbangan\Pages\ViewModulPenerbangan;
use App\Filament\Resources\ModulPenerbangan\Schemas\ModulPenerbanganForm;
use App\Filament\Resources\ModulPenerbangan\Schemas\ModulPenerbanganInfolist;
use App\Filament\Resources\ModulPenerbangan\Tables\ModulPenerbangansTable;
use App\Models\ModulPenerbangan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class ModulPenerbanganResource extends Resource
{
    protected static ?string $model = ModulPenerbangan::class;

    protected static ?string $slug = 'training-modules';

    protected static ?string $modelLabel = 'Flight Module';

    protected static ?string $pluralModelLabel = 'Flight Modules';

    protected static ?string $navigationLabel = 'Flight Modules';

    protected static string | \UnitEnum | null $navigationGroup = 'Master Data';
    protected static ?int $navigationSort = 6;
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-book-open';

    public static function form(Schema $schema): Schema
    {
        return ModulPenerbanganForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ModulPenerbanganInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ModulPenerbangansTable::configure($table);
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
            'index' => ListModulPenerbangans::route('/'),
            'create' => CreateModulPenerbangan::route('/create'),
            'view' => ViewModulPenerbangan::route('/{record}'),
            'edit' => EditModulPenerbangan::route('/{record}/edit'),
        ];
    }
}

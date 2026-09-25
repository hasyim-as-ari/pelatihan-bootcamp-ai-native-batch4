<?php

namespace App\Filament\Resources\SlotWaktu;

use App\Filament\Resources\SlotWaktu\Pages\CreateSlotWaktu;
use App\Filament\Resources\SlotWaktu\Pages\EditSlotWaktu;
use App\Filament\Resources\SlotWaktu\Pages\ListSlotWaktus;
use App\Filament\Resources\SlotWaktu\Pages\ViewSlotWaktu;
use App\Filament\Resources\SlotWaktu\Schemas\SlotWaktuForm;
use App\Filament\Resources\SlotWaktu\Schemas\SlotWaktuInfolist;
use App\Filament\Resources\SlotWaktu\Tables\SlotWaktusTable;
use App\Models\SlotWaktu;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SlotWaktuResource extends Resource
{
    protected static ?string $model = SlotWaktu::class;

    protected static ?string $slug = 'time-slots';

    protected static ?string $modelLabel = 'Time Slot';

    protected static ?string $pluralModelLabel = 'Time Slots';

    protected static ?string $navigationLabel = 'Time Slots';

    protected static string | \UnitEnum | null $navigationGroup = 'Master Data';
    protected static ?int $navigationSort = 4;
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-clock';

    public static function form(Schema $schema): Schema
    {
        return SlotWaktuForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SlotWaktuInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SlotWaktusTable::configure($table);
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
            'index' => ListSlotWaktus::route('/'),
            'create' => CreateSlotWaktu::route('/create'),
            'view' => ViewSlotWaktu::route('/{record}'),
            'edit' => EditSlotWaktu::route('/{record}/edit'),
        ];
    }
}




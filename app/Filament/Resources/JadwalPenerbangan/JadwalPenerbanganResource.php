<?php

namespace App\Filament\Resources\JadwalPenerbangan;

use App\Filament\Resources\JadwalPenerbangan\Pages\CreateJadwalPenerbangan;
use App\Filament\Resources\JadwalPenerbangan\Pages\EditJadwalPenerbangan;
use App\Filament\Resources\JadwalPenerbangan\Pages\ListJadwalPenerbangans;
use App\Filament\Resources\JadwalPenerbangan\Pages\ViewJadwalPenerbangan;
use App\Filament\Resources\JadwalPenerbangan\Schemas\JadwalPenerbanganForm;
use App\Filament\Resources\JadwalPenerbangan\Schemas\JadwalPenerbanganInfolist;
use App\Filament\Resources\JadwalPenerbangan\Tables\JadwalPenerbangansTable;
use App\Models\JadwalPenerbangan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class JadwalPenerbanganResource extends Resource
{
    protected static ?string $model = JadwalPenerbangan::class;

    protected static ?string $slug = 'flight-schedules';

    protected static ?string $modelLabel = 'Flight Schedule';

    protected static ?string $pluralModelLabel = 'Flight Schedules';

    public static function getNavigationLabel(): string
    {
        $user = auth()->user();
        if ($user && $user->hasRole('taruna')) {
            return 'My Flight Schedules';
        }

        return 'Flight Schedules';
    }

    public static function getNavigationGroup(): ?string
    {
        $user = auth()->user();
        if ($user && ($user->hasRole('taruna') || $user->hasRole('instruktur'))) {
            return null;
        }

        return 'Flight Operations';
    }

    protected static ?int $navigationSort = 1;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-calendar-days';

    public static function form(Schema $schema): Schema
    {
        return JadwalPenerbanganForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return JadwalPenerbanganInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return JadwalPenerbangansTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getEloquentQuery(): Builder
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
            'index' => ListJadwalPenerbangans::route('/'),
            'create' => CreateJadwalPenerbangan::route('/create'),
            'view' => ViewJadwalPenerbangan::route('/{record}'),
            'edit' => EditJadwalPenerbangan::route('/{record}/edit'),
        ];
    }
}

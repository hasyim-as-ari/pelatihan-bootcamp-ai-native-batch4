<?php

namespace App\Filament\Resources\PengajuanReschedule;

use App\Filament\Resources\PengajuanReschedule\Pages\CreatePengajuanReschedule;
use App\Filament\Resources\PengajuanReschedule\Pages\EditPengajuanReschedule;
use App\Filament\Resources\PengajuanReschedule\Pages\ListPengajuanReschedules;
use App\Filament\Resources\PengajuanReschedule\Pages\ViewPengajuanReschedule;
use App\Filament\Resources\PengajuanReschedule\Schemas\PengajuanRescheduleForm;
use App\Filament\Resources\PengajuanReschedule\Schemas\PengajuanRescheduleInfolist;
use App\Filament\Resources\PengajuanReschedule\Tables\PengajuanReschedulesTable;
use App\Models\PengajuanReschedule;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PengajuanRescheduleResource extends Resource
{
    protected static ?string $model = PengajuanReschedule::class;

    protected static ?string $pluralModelLabel = 'Pengajuan Reschedule';

    protected static string | \UnitEnum | null $navigationGroup = 'Operasional Penerbangan';
    protected static ?int $navigationSort = 3;
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-arrow-path';

    public static function form(Schema $schema): Schema
    {
        return PengajuanRescheduleForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PengajuanRescheduleInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PengajuanReschedulesTable::configure($table);
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

        return $query->where('pemohon_id', $user->id);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPengajuanReschedules::route('/'),
            'create' => CreatePengajuanReschedule::route('/create'),
            'view' => ViewPengajuanReschedule::route('/{record}'),
            'edit' => EditPengajuanReschedule::route('/{record}/edit'),
        ];
    }
}




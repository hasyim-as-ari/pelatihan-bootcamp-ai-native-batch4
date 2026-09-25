<?php
namespace App\Filament\Resources\LoginHistory;
use App\Filament\Resources\LoginHistory\Pages\ListLoginHistories;
use App\Filament\Resources\LoginHistory\Pages\ViewLoginHistory;
use App\Filament\Resources\LoginHistory\Tables\LoginHistoriesTable;
use App\Models\LoginHistory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Tables\Table;
class LoginHistoryResource extends Resource {
    protected static ?string $model = LoginHistory::class;
    protected static ?string $slug = 'login-histories';
    protected static ?string $modelLabel = 'Login History';
    protected static ?string $pluralModelLabel = 'Login History';
    protected static ?string $navigationLabel = 'Login History';
    protected static string|\UnitEnum|null $navigationGroup = 'Reports & History';
    protected static ?int $navigationSort = 2;
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-shield-check';
    public static function canCreate(): bool { return false; }
    public static function table(Table $table): Table { return LoginHistoriesTable::configure($table); }
    public static function getPages(): array {
        return [
            'index' => ListLoginHistories::route('/'),
            'view'  => ViewLoginHistory::route('/{record}'),
        ];
    }
}

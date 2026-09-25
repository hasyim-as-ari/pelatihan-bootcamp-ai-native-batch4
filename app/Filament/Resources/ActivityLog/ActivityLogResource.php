<?php
namespace App\Filament\Resources\ActivityLog;
use App\Filament\Resources\ActivityLog\Pages\ListActivityLogs;
use App\Filament\Resources\ActivityLog\Pages\ViewActivityLog;
use App\Filament\Resources\ActivityLog\Tables\ActivityLogsTable;
use App\Models\ActivityLog;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
class ActivityLogResource extends Resource {
    protected static ?string $model = ActivityLog::class;
    protected static ?string $slug = 'activity-logs';
    protected static ?string $modelLabel = 'Activity Log';
    protected static ?string $pluralModelLabel = 'Activity Logs (Audit Trail)';
    protected static ?string $navigationLabel = 'Activity Logs';
    protected static string|\UnitEnum|null $navigationGroup = 'Reports & History';
    protected static ?int $navigationSort = 1;
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-clipboard-document-list';
    public static function canCreate(): bool { return false; }
    public static function table(Table $table): Table { return ActivityLogsTable::configure($table); }
    public static function getPages(): array {
        return [
            'index' => ListActivityLogs::route('/'),
            'view'  => ViewActivityLog::route('/{record}'),
        ];
    }
}

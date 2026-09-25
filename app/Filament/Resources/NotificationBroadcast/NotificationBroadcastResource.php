<?php
namespace App\Filament\Resources\NotificationBroadcast;
use App\Filament\Resources\NotificationBroadcast\Pages\CreateNotificationBroadcast;
use App\Filament\Resources\NotificationBroadcast\Pages\EditNotificationBroadcast;
use App\Filament\Resources\NotificationBroadcast\Pages\ListNotificationBroadcasts;
use App\Filament\Resources\NotificationBroadcast\Pages\ViewNotificationBroadcast;
use App\Filament\Resources\NotificationBroadcast\Schemas\NotificationBroadcastForm;
use App\Filament\Resources\NotificationBroadcast\Tables\NotificationBroadcastsTable;
use App\Models\NotificationBroadcast;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
class NotificationBroadcastResource extends Resource {
    protected static ?string $model = NotificationBroadcast::class;
    protected static ?string $slug = 'notifications';
    protected static ?string $modelLabel = 'Notification';
    protected static ?string $pluralModelLabel = 'Notifications / Broadcast';
    protected static ?string $navigationLabel = 'Notifications / Broadcast';
    protected static string|\UnitEnum|null $navigationGroup = 'Settings';
    protected static ?int $navigationSort = 4;
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-bell-alert';
    public static function form(Schema $schema): Schema { return NotificationBroadcastForm::configure($schema); }
    public static function table(Table $table): Table { return NotificationBroadcastsTable::configure($table); }
    public static function getRelations(): array { return []; }
    public static function getPages(): array {
        return [
            'index'  => ListNotificationBroadcasts::route('/'),
            'create' => CreateNotificationBroadcast::route('/create'),
            'view'   => ViewNotificationBroadcast::route('/{record}'),
            'edit'   => EditNotificationBroadcast::route('/{record}/edit'),
        ];
    }
}

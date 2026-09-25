<?php
namespace App\Filament\Resources\NotificationBroadcast\Pages;
use App\Filament\Resources\NotificationBroadcast\NotificationBroadcastResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
class EditNotificationBroadcast extends EditRecord { protected static string $resource = NotificationBroadcastResource::class; protected function getHeaderActions(): array { return [DeleteAction::make()]; } }

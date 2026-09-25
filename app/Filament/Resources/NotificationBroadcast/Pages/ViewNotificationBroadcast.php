<?php
namespace App\Filament\Resources\NotificationBroadcast\Pages;
use App\Filament\Resources\NotificationBroadcast\NotificationBroadcastResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
class ViewNotificationBroadcast extends ViewRecord { protected static string $resource = NotificationBroadcastResource::class; protected function getHeaderActions(): array { return [EditAction::make()]; } }

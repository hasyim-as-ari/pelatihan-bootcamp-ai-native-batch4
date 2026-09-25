<?php
namespace App\Filament\Resources\NotificationBroadcast\Pages;
use App\Filament\Resources\NotificationBroadcast\NotificationBroadcastResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
class ListNotificationBroadcasts extends ListRecords { protected static string $resource = NotificationBroadcastResource::class; protected function getHeaderActions(): array { return [CreateAction::make()]; } }

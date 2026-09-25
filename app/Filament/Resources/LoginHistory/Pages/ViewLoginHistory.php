<?php
namespace App\Filament\Resources\LoginHistory\Pages;
use App\Filament\Resources\LoginHistory\LoginHistoryResource;
use Filament\Resources\Pages\ViewRecord;
class ViewLoginHistory extends ViewRecord {
    protected static string $resource = LoginHistoryResource::class;
    protected function getHeaderActions(): array { return []; }
}

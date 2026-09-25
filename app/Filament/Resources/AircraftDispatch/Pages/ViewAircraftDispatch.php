<?php
namespace App\Filament\Resources\AircraftDispatch\Pages;
use App\Filament\Resources\AircraftDispatch\AircraftDispatchResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
class ViewAircraftDispatch extends ViewRecord {
    protected static string $resource = AircraftDispatchResource::class;
    protected function getHeaderActions(): array { return [EditAction::make()]; }
}

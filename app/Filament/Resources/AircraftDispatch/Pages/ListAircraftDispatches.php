<?php
namespace App\Filament\Resources\AircraftDispatch\Pages;
use App\Filament\Resources\AircraftDispatch\AircraftDispatchResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
class ListAircraftDispatches extends ListRecords {
    protected static string $resource = AircraftDispatchResource::class;
    protected function getHeaderActions(): array { return [CreateAction::make()]; }
}

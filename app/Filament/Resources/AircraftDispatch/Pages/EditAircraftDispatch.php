<?php
namespace App\Filament\Resources\AircraftDispatch\Pages;
use App\Filament\Resources\AircraftDispatch\AircraftDispatchResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
class EditAircraftDispatch extends EditRecord {
    protected static string $resource = AircraftDispatchResource::class;
    protected function getHeaderActions(): array { return [DeleteAction::make()]; }
}

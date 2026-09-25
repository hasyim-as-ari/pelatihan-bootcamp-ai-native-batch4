<?php
namespace App\Filament\Resources\FlightHoursReport\Pages;
use App\Filament\Resources\FlightHoursReport\FlightHoursReportResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
class EditFlightHoursReport extends EditRecord { protected static string $resource = FlightHoursReportResource::class; protected function getHeaderActions(): array { return [DeleteAction::make()]; } }

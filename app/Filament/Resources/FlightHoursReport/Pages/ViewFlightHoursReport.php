<?php
namespace App\Filament\Resources\FlightHoursReport\Pages;
use App\Filament\Resources\FlightHoursReport\FlightHoursReportResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
class ViewFlightHoursReport extends ViewRecord { protected static string $resource = FlightHoursReportResource::class; protected function getHeaderActions(): array { return [EditAction::make()]; } }

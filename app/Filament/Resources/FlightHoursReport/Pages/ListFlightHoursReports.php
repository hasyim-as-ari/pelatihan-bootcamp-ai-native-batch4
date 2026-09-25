<?php

namespace App\Filament\Resources\FlightHoursReport\Pages;

use App\Filament\Resources\FlightHoursReport\FlightHoursReportResource;
use Filament\Resources\Pages\ListRecords;

class ListFlightHoursReports extends ListRecords
{
    protected static string $resource = FlightHoursReportResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}

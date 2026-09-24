<?php

namespace App\Filament\Resources\FlightLog\Pages;

use App\Filament\Resources\FlightLog\FlightLogResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewFlightLog extends ViewRecord
{
    protected static string $resource = FlightLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}


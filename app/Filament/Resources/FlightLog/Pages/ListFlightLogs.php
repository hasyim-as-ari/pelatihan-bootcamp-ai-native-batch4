<?php

namespace App\Filament\Resources\FlightLog\Pages;

use App\Filament\Resources\FlightLog\FlightLogResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFlightLogs extends ListRecords
{
    protected static string $resource = FlightLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}


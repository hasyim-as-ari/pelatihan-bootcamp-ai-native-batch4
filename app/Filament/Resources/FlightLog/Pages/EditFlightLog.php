<?php

namespace App\Filament\Resources\FlightLog\Pages;

use App\Filament\Resources\FlightLog\FlightLogResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditFlightLog extends EditRecord
{
    protected static string $resource = FlightLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}


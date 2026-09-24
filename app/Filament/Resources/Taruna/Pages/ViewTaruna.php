<?php

namespace App\Filament\Resources\Taruna\Pages;

use App\Filament\Resources\Taruna\TarunaResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewTaruna extends ViewRecord
{
    protected static string $resource = TarunaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}


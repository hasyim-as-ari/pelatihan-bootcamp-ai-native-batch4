<?php

namespace App\Filament\Resources\Taruna\Pages;

use App\Filament\Resources\Taruna\TarunaResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTaruna extends CreateRecord
{
    protected static string $resource = TarunaResource::class;

    protected function afterCreate(): void
    {
        $this->record->syncModulPenerbanganString();
    }
}


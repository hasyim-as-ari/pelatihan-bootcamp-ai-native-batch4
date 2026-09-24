<?php

namespace App\Filament\Resources\Taruna\Pages;

use App\Filament\Resources\Taruna\TarunaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTarunas extends ListRecords
{
    protected static string $resource = TarunaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}


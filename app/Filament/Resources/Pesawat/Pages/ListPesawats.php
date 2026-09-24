<?php

namespace App\Filament\Resources\Pesawat\Pages;

use App\Filament\Resources\Pesawat\PesawatResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPesawats extends ListRecords
{
    protected static string $resource = PesawatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}


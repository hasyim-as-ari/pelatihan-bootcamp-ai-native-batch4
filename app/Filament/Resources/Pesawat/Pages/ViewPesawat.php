<?php

namespace App\Filament\Resources\Pesawat\Pages;

use App\Filament\Resources\Pesawat\PesawatResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPesawat extends ViewRecord
{
    protected static string $resource = PesawatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}


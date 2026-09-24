<?php

namespace App\Filament\Resources\JadwalPenerbangan\Pages;

use App\Filament\Resources\JadwalPenerbangan\JadwalPenerbanganResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewJadwalPenerbangan extends ViewRecord
{
    protected static string $resource = JadwalPenerbanganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}


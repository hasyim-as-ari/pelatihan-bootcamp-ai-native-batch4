<?php

namespace App\Filament\Resources\JadwalPenerbangan\Pages;

use App\Filament\Resources\JadwalPenerbangan\JadwalPenerbanganResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListJadwalPenerbangans extends ListRecords
{
    protected static string $resource = JadwalPenerbanganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}


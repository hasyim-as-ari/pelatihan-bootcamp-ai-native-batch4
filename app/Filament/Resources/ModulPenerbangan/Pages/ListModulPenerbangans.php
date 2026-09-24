<?php

namespace App\Filament\Resources\ModulPenerbangan\Pages;

use App\Filament\Resources\ModulPenerbangan\ModulPenerbanganResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListModulPenerbangans extends ListRecords
{
    protected static string $resource = ModulPenerbanganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

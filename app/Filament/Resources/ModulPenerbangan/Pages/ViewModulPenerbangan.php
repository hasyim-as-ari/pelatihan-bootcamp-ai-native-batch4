<?php

namespace App\Filament\Resources\ModulPenerbangan\Pages;

use App\Filament\Resources\ModulPenerbangan\ModulPenerbanganResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewModulPenerbangan extends ViewRecord
{
    protected static string $resource = ModulPenerbanganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}

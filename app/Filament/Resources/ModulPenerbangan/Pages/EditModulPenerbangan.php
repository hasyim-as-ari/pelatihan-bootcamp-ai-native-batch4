<?php

namespace App\Filament\Resources\ModulPenerbangan\Pages;

use App\Filament\Resources\ModulPenerbangan\ModulPenerbanganResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditModulPenerbangan extends EditRecord
{
    protected static string $resource = ModulPenerbanganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}

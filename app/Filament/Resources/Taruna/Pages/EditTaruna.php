<?php

namespace App\Filament\Resources\Taruna\Pages;

use App\Filament\Resources\Taruna\TarunaResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditTaruna extends EditRecord
{
    protected static string $resource = TarunaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        $this->record->syncModulPenerbanganString();
    }
}


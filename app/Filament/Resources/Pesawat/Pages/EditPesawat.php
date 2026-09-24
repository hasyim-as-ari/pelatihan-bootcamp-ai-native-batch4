<?php

namespace App\Filament\Resources\Pesawat\Pages;

use App\Filament\Resources\Pesawat\PesawatResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditPesawat extends EditRecord
{
    protected static string $resource = PesawatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}


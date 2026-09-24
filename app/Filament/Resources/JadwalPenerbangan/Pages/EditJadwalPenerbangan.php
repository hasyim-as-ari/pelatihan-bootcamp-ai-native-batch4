<?php

namespace App\Filament\Resources\JadwalPenerbangan\Pages;

use App\Filament\Resources\JadwalPenerbangan\JadwalPenerbanganResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditJadwalPenerbangan extends EditRecord
{
    protected static string $resource = JadwalPenerbanganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}


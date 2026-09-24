<?php

namespace App\Filament\Resources\SlotWaktu\Pages;

use App\Filament\Resources\SlotWaktu\SlotWaktuResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditSlotWaktu extends EditRecord
{
    protected static string $resource = SlotWaktuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}


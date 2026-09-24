<?php

namespace App\Filament\Resources\SlotWaktu\Pages;

use App\Filament\Resources\SlotWaktu\SlotWaktuResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSlotWaktu extends ViewRecord
{
    protected static string $resource = SlotWaktuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}


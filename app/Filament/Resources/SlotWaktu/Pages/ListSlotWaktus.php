<?php

namespace App\Filament\Resources\SlotWaktu\Pages;

use App\Filament\Resources\SlotWaktu\SlotWaktuResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSlotWaktus extends ListRecords
{
    protected static string $resource = SlotWaktuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}


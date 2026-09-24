<?php

namespace App\Filament\Resources\PengajuanReschedule\Pages;

use App\Filament\Resources\PengajuanReschedule\PengajuanRescheduleResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPengajuanReschedules extends ListRecords
{
    protected static string $resource = PengajuanRescheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}


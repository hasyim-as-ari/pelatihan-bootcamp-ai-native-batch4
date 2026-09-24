<?php

namespace App\Filament\Resources\PengajuanReschedule\Pages;

use App\Filament\Resources\PengajuanReschedule\PengajuanRescheduleResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPengajuanReschedule extends ViewRecord
{
    protected static string $resource = PengajuanRescheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}


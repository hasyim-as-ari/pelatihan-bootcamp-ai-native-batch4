<?php

namespace App\Filament\Resources\PengajuanReschedule\Pages;

use App\Filament\Resources\PengajuanReschedule\PengajuanRescheduleResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditPengajuanReschedule extends EditRecord
{
    protected static string $resource = PengajuanRescheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}


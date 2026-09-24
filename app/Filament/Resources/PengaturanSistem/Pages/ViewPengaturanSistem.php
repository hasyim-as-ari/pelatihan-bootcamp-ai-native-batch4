<?php

namespace App\Filament\Resources\PengaturanSistem\Pages;

use App\Filament\Resources\PengaturanSistem\PengaturanSistemResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPengaturanSistem extends ViewRecord
{
    protected static string $resource = PengaturanSistemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}


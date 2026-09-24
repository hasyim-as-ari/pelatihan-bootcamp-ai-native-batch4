<?php

namespace App\Filament\Resources\PengaturanSistem\Pages;

use App\Filament\Resources\PengaturanSistem\PengaturanSistemResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditPengaturanSistem extends EditRecord
{
    protected static string $resource = PengaturanSistemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}


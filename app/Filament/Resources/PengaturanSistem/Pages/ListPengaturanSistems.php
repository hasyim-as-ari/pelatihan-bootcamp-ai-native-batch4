<?php

namespace App\Filament\Resources\PengaturanSistem\Pages;

use App\Filament\Resources\PengaturanSistem\PengaturanSistemResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPengaturanSistems extends ListRecords
{
    protected static string $resource = PengaturanSistemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}


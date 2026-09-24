<?php

namespace App\Filament\Resources\Instruktur\Pages;

use App\Filament\Resources\Instruktur\InstrukturResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditInstruktur extends EditRecord
{
    protected static string $resource = InstrukturResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}


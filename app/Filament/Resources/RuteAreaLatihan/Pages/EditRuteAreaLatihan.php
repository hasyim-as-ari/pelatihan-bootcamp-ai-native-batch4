<?php

namespace App\Filament\Resources\RuteAreaLatihan\Pages;

use App\Filament\Resources\RuteAreaLatihan\RuteAreaLatihanResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditRuteAreaLatihan extends EditRecord
{
    protected static string $resource = RuteAreaLatihanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}

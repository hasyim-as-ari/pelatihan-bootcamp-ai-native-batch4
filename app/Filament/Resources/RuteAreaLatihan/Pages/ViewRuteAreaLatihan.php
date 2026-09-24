<?php

namespace App\Filament\Resources\RuteAreaLatihan\Pages;

use App\Filament\Resources\RuteAreaLatihan\RuteAreaLatihanResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewRuteAreaLatihan extends ViewRecord
{
    protected static string $resource = RuteAreaLatihanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}

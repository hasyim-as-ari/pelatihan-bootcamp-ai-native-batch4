<?php

namespace App\Filament\Resources\RuteAreaLatihan\Pages;

use App\Filament\Resources\RuteAreaLatihan\RuteAreaLatihanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRuteAreaLatihans extends ListRecords
{
    protected static string $resource = RuteAreaLatihanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

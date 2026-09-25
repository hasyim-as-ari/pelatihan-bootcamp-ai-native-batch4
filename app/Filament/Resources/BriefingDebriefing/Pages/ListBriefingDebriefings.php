<?php
namespace App\Filament\Resources\BriefingDebriefing\Pages;
use App\Filament\Resources\BriefingDebriefing\BriefingDebriefingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
class ListBriefingDebriefings extends ListRecords {
    protected static string $resource = BriefingDebriefingResource::class;
    protected function getHeaderActions(): array { return [CreateAction::make()]; }
}

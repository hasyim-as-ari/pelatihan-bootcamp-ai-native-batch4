<?php
namespace App\Filament\Resources\BriefingDebriefing\Pages;
use App\Filament\Resources\BriefingDebriefing\BriefingDebriefingResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
class ViewBriefingDebriefing extends ViewRecord {
    protected static string $resource = BriefingDebriefingResource::class;
    protected function getHeaderActions(): array { return [EditAction::make()]; }
}

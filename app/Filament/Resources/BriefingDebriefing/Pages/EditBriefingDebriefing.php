<?php
namespace App\Filament\Resources\BriefingDebriefing\Pages;
use App\Filament\Resources\BriefingDebriefing\BriefingDebriefingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
class EditBriefingDebriefing extends EditRecord {
    protected static string $resource = BriefingDebriefingResource::class;
    protected function getHeaderActions(): array { return [DeleteAction::make()]; }
}

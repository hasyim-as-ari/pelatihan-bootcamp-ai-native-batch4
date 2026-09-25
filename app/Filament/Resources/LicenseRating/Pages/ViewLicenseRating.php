<?php
namespace App\Filament\Resources\LicenseRating\Pages;
use App\Filament\Resources\LicenseRating\LicenseRatingResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
class ViewLicenseRating extends ViewRecord {
    protected static string $resource = LicenseRatingResource::class;
    protected function getHeaderActions(): array { return [EditAction::make()]; }
}

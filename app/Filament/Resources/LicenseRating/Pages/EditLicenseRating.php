<?php
namespace App\Filament\Resources\LicenseRating\Pages;
use App\Filament\Resources\LicenseRating\LicenseRatingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
class EditLicenseRating extends EditRecord {
    protected static string $resource = LicenseRatingResource::class;
    protected function getHeaderActions(): array { return [DeleteAction::make()]; }
}

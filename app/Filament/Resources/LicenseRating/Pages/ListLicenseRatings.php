<?php
namespace App\Filament\Resources\LicenseRating\Pages;
use App\Filament\Resources\LicenseRating\LicenseRatingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
class ListLicenseRatings extends ListRecords {
    protected static string $resource = LicenseRatingResource::class;
    protected function getHeaderActions(): array { return [CreateAction::make()]; }
}

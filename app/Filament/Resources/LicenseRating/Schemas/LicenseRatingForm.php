<?php
namespace App\Filament\Resources\LicenseRating\Schemas;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
class LicenseRatingForm {
    public static function configure(Schema $schema): Schema {
        return $schema->components([
            TextInput::make('code')->label('Code')->placeholder('e.g. PPL, CPL, IR, ATPL')->required()->unique(ignoreRecord: true)->maxLength(20)->helperText('Short identifier used in the system'),
            TextInput::make('name')->label('Full Name')->placeholder('e.g. Private Pilot License')->required()->maxLength(100),
            Select::make('type')->label('Type')->options(['license'=>'License','rating'=>'Rating'])->required()->default('license')->helperText('License = standalone certificate; Rating = add-on endorsement'),
            TextInput::make('min_flight_hours')->label('Minimum Flight Hours Required')->numeric()->default(0)->suffix('hrs')->helperText('Minimum hours before issuance'),
            TextInput::make('validity_months')->label('Validity Period (months)')->numeric()->placeholder('Leave blank if no expiry')->helperText('e.g. 24 = valid 2 years'),
            Toggle::make('is_active')->label('Active')->default(true)->helperText('Only active licenses appear in dropdowns'),
            Textarea::make('description')->label('Description / Notes')->placeholder('Applicable regulations, prerequisites...')->columnSpanFull()->rows(3),
        ]);
    }
}

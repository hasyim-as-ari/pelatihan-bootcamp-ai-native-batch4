<?php
namespace App\Filament\Resources\LicenseRating;
use App\Filament\Resources\LicenseRating\Pages\CreateLicenseRating;
use App\Filament\Resources\LicenseRating\Pages\EditLicenseRating;
use App\Filament\Resources\LicenseRating\Pages\ListLicenseRatings;
use App\Filament\Resources\LicenseRating\Pages\ViewLicenseRating;
use App\Filament\Resources\LicenseRating\Schemas\LicenseRatingForm;
use App\Filament\Resources\LicenseRating\Tables\LicenseRatingsTable;
use App\Models\LicenseRating;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
class LicenseRatingResource extends Resource
{
    protected static ?string $model = LicenseRating::class;
    protected static ?string $slug = 'licenses-ratings';
    protected static ?string $modelLabel = 'License & Rating';
    protected static ?string $pluralModelLabel = 'Licenses & Ratings';
    protected static ?string $navigationLabel = 'Licenses & Ratings';
    protected static string|\UnitEnum|null $navigationGroup = 'Master Data';
    protected static ?int $navigationSort = 5;
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-identification';
    public static function form(Schema $schema): Schema { return LicenseRatingForm::configure($schema); }
    public static function table(Table $table): Table { return LicenseRatingsTable::configure($table); }
    public static function getRelations(): array { return []; }
    public static function getPages(): array {
        return [
            'index'  => ListLicenseRatings::route('/'),
            'create' => CreateLicenseRating::route('/create'),
            'view'   => ViewLicenseRating::route('/{record}'),
            'edit'   => EditLicenseRating::route('/{record}/edit'),
        ];
    }
}

<?php
namespace App\Filament\Resources\BriefingDebriefing;
use App\Filament\Resources\BriefingDebriefing\Pages\CreateBriefingDebriefing;
use App\Filament\Resources\BriefingDebriefing\Pages\EditBriefingDebriefing;
use App\Filament\Resources\BriefingDebriefing\Pages\ListBriefingDebriefings;
use App\Filament\Resources\BriefingDebriefing\Pages\ViewBriefingDebriefing;
use App\Filament\Resources\BriefingDebriefing\Schemas\BriefingDebriefingForm;
use App\Filament\Resources\BriefingDebriefing\Tables\BriefingDebriefingsTable;
use App\Models\BriefingDebriefing;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
class BriefingDebriefingResource extends Resource {
    protected static ?string $model = BriefingDebriefing::class;
    protected static ?string $slug = 'briefing-debriefings';
    protected static ?string $modelLabel = 'Briefing / Debriefing';
    protected static ?string $pluralModelLabel = 'Briefing & Debriefing';
    protected static ?string $navigationLabel = 'Briefing & Debriefing';
    protected static string|\UnitEnum|null $navigationGroup = 'Flight Operations';
    protected static ?int $navigationSort = 4;
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    public static function form(Schema $schema): Schema { return BriefingDebriefingForm::configure($schema); }
    public static function table(Table $table): Table { return BriefingDebriefingsTable::configure($table); }
    public static function getRelations(): array { return []; }
    public static function getPages(): array {
        return [
            'index'  => ListBriefingDebriefings::route('/'),
            'create' => CreateBriefingDebriefing::route('/create'),
            'view'   => ViewBriefingDebriefing::route('/{record}'),
            'edit'   => EditBriefingDebriefing::route('/{record}/edit'),
        ];
    }
}

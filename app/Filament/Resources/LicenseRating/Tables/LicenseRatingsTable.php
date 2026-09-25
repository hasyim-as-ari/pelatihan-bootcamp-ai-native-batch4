<?php
namespace App\Filament\Resources\LicenseRating\Tables;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
class LicenseRatingsTable {
    public static function configure(Table $table): Table {
        return $table->columns([
            TextColumn::make('code')->label('Code')->badge()->color('primary')->searchable()->sortable(),
            TextColumn::make('name')->label('Full Name')->searchable()->sortable()->wrap(),
            TextColumn::make('type')->label('Type')->badge()->color(fn($state)=>$state==='license'?'success':'info')->formatStateUsing(fn($s)=>ucfirst($s)),
            TextColumn::make('min_flight_hours')->label('Min Hours')->numeric(2)->suffix(' hrs')->sortable(),
            TextColumn::make('validity_months')->label('Validity')->formatStateUsing(fn($s)=>$s?$s.' months':'No Expiry')->sortable(),
            IconColumn::make('is_active')->label('Active')->boolean(),
            TextColumn::make('tarunas_count')->label('Students')->counts('tarunas')->badge()->color('gray'),
        ])
        ->filters([
            SelectFilter::make('type')->options(['license'=>'License','rating'=>'Rating']),
            SelectFilter::make('is_active')->label('Status')->options(['1'=>'Active','0'=>'Inactive']),
        ])
        ->recordActions([ViewAction::make(), EditAction::make()])
        ->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }
}

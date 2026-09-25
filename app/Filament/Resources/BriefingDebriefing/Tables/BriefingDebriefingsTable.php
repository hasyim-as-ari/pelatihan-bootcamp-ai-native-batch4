<?php
namespace App\Filament\Resources\BriefingDebriefing\Tables;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
class BriefingDebriefingsTable {
    public static function configure(Table $table): Table {
        return $table
        ->defaultSort('date','desc')
        ->columns([
            TextColumn::make('date')->label('Date')->date()->sortable(),
            TextColumn::make('type')->label('Type')->badge()->color(fn($s)=>$s==='briefing'?'info':'success')->formatStateUsing(fn($s)=>$s==='briefing'?'Pre-Flight Briefing':'Post-Flight Debriefing'),
            TextColumn::make('instruktur.nama')->label('Instructor')->searchable()->sortable(),
            TextColumn::make('taruna.nama')->label('Student')->searchable()->sortable(),
            TextColumn::make('time_start')->label('Start')->time('H:i'),
            TextColumn::make('performance_rating')->label('Rating')->badge()->color(fn($s)=>match($s){'excellent'=>'success','good'=>'primary','satisfactory'=>'info','needs_improvement'=>'warning','unsatisfactory'=>'danger',default=>'gray'})->formatStateUsing(fn($s)=>$s?ucwords(str_replace('_',' ',$s)):'-'),
            IconColumn::make('cleared_for_flight')->label('Cleared')->boolean(),
            TextColumn::make('status')->label('Status')->badge()->color(fn($s)=>match($s){'completed'=>'success','scheduled'=>'info','cancelled'=>'danger',default=>'gray'})->formatStateUsing(fn($s)=>ucfirst($s)),
        ])
        ->filters([
            SelectFilter::make('type')->options(['briefing'=>'Briefing','debriefing'=>'Debriefing']),
            SelectFilter::make('status')->options(['scheduled'=>'Scheduled','completed'=>'Completed','cancelled'=>'Cancelled']),
        ])
        ->recordActions([ViewAction::make(),EditAction::make()])
        ->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }
}

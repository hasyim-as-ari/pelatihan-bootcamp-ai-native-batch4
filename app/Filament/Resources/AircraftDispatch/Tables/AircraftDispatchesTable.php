<?php
namespace App\Filament\Resources\AircraftDispatch\Tables;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
class AircraftDispatchesTable {
    public static function configure(Table $table): Table {
        return $table->defaultSort('dispatch_date','desc')->columns([
            TextColumn::make('dispatch_number')->label('Dispatch #')->badge()->color('primary')->searchable()->sortable(),
            TextColumn::make('dispatch_date')->label('Date')->date()->sortable(),
            TextColumn::make('pesawat.nomor_registrasi')->label('Aircraft')->searchable()->sortable(),
            TextColumn::make('instruktur.nama')->label('Instructor')->searchable(),
            TextColumn::make('taruna.nama')->label('Student')->searchable(),
            TextColumn::make('actual_departure')->label('Departure')->time('H:i'),
            TextColumn::make('actual_return')->label('Return')->time('H:i'),
            TextColumn::make('hobbs_start')->label('Hobbs Start')->numeric(2)->suffix('h')->toggleable(isToggledHiddenByDefault:true),
            TextColumn::make('hobbs_end')->label('Hobbs End')->numeric(2)->suffix('h')->toggleable(isToggledHiddenByDefault:true),
            TextColumn::make('status')->label('Status')->badge()->color(fn($s)=>match($s){'planned'=>'gray','dispatched'=>'info','airborne'=>'warning','returned'=>'success','cancelled'=>'danger',default=>'gray'})->formatStateUsing(fn($s)=>ucfirst($s)),
        ])
        ->filters([SelectFilter::make('status')->options(['planned'=>'Planned','dispatched'=>'Dispatched','airborne'=>'Airborne','returned'=>'Returned','cancelled'=>'Cancelled'])])
        ->recordActions([ViewAction::make(),EditAction::make()])
        ->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }
}

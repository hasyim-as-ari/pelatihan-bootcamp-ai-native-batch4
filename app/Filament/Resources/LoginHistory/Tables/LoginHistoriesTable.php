<?php
namespace App\Filament\Resources\LoginHistory\Tables;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
class LoginHistoriesTable {
    public static function configure(Table $table): Table {
        return $table->defaultSort('logged_at','desc')->columns([
            TextColumn::make('logged_at')->label('Date & Time')->dateTime('d M Y H:i:s')->sortable(),
            TextColumn::make('email')->label('Email Attempted')->searchable(),
            TextColumn::make('user.name')->label('User')->searchable()->default('Unknown'),
            TextColumn::make('status')->label('Status')->badge()->color(fn($s)=>match($s){'success'=>'success','failed'=>'danger','locked'=>'warning',default=>'gray'})->formatStateUsing(fn($s)=>ucfirst($s)),
            TextColumn::make('failure_reason')->label('Failure Reason')->limit(50)->toggleable(isToggledHiddenByDefault:false)->placeholder('-'),
            TextColumn::make('ip_address')->label('IP Address')->searchable(),
            TextColumn::make('user_agent')->label('Browser/Device')->limit(40)->toggleable(isToggledHiddenByDefault:true),
        ])
        ->filters([SelectFilter::make('status')->options(['success'=>'Success','failed'=>'Failed','locked'=>'Locked'])])
        ->recordActions([ViewAction::make()])
        ->toolbarActions([]);
    }
}

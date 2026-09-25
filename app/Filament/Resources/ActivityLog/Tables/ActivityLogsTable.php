<?php
namespace App\Filament\Resources\ActivityLog\Tables;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
class ActivityLogsTable {
    public static function configure(Table $table): Table {
        return $table->defaultSort('created_at','desc')->columns([
            TextColumn::make('created_at')->label('Date & Time')->dateTime('d M Y H:i:s')->sortable(),
            TextColumn::make('user.name')->label('User')->searchable()->sortable(),
            TextColumn::make('action_type')->label('Action')->badge()->color(fn($s)=>match($s){'LOGIN'=>'success','LOGOUT'=>'gray','INSERT'=>'info','UPDATE'=>'warning','DELETE'=>'danger','PRINT'=>'primary','EXPORT'=>'primary','VIEW'=>'gray',default=>'gray'}),
            TextColumn::make('module_name')->label('Module')->badge()->color('gray')->searchable(),
            TextColumn::make('description')->label('Description')->limit(80)->searchable()->wrap(),
            TextColumn::make('ip_address')->label('IP')->toggleable(isToggledHiddenByDefault:true),
        ])
        ->filters([
            SelectFilter::make('action_type')->label('Action')->options(['LOGIN'=>'Login','LOGOUT'=>'Logout','INSERT'=>'Insert','UPDATE'=>'Update','DELETE'=>'Delete','PRINT'=>'Print','EXPORT'=>'Export','VIEW'=>'View']),
        ])
        ->recordActions([ViewAction::make()])
        ->toolbarActions([]);
    }
}

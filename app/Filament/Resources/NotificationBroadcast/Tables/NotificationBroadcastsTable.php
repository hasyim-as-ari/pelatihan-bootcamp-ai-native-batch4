<?php
namespace App\Filament\Resources\NotificationBroadcast\Tables;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
class NotificationBroadcastsTable {
    public static function configure(Table $table): Table {
        return $table->defaultSort('created_at','desc')->columns([
            TextColumn::make('title')->label('Title')->searchable()->limit(50)->sortable(),
            TextColumn::make('channel')->label('Channel')->badge()->color(fn($s)=>match($s){'system'=>'gray','email'=>'info','whatsapp'=>'success','both'=>'primary',default=>'gray'})->formatStateUsing(fn($s)=>match($s){'both'=>'Email+WA',default=>ucfirst($s)}),
            TextColumn::make('target_role')->label('Target')->badge()->color('gray')->formatStateUsing(fn($s)=>ucfirst($s)),
            TextColumn::make('priority')->label('Priority')->badge()->color(fn($s)=>match($s){'low'=>'gray','normal'=>'info','high'=>'warning','urgent'=>'danger',default=>'gray'})->formatStateUsing(fn($s)=>ucfirst($s)),
            TextColumn::make('scheduled_at')->label('Scheduled At')->dateTime('d M Y H:i')->placeholder('Immediate'),
            TextColumn::make('sent_at')->label('Sent At')->dateTime('d M Y H:i')->placeholder('-'),
            TextColumn::make('recipients_count')->label('Recipients')->numeric()->sortable(),
            TextColumn::make('delivered_count')->label('Delivered')->numeric()->sortable(),
            TextColumn::make('status')->label('Status')->badge()->color(fn($s)=>match($s){'draft'=>'gray','queued'=>'info','sending'=>'warning','sent'=>'success','failed'=>'danger','cancelled'=>'gray',default=>'gray'})->formatStateUsing(fn($s)=>ucfirst($s)),
        ])
        ->filters([SelectFilter::make('channel')->options(['system'=>'System','email'=>'Email','whatsapp'=>'WhatsApp','both'=>'Both']),SelectFilter::make('status')->options(['draft'=>'Draft','queued'=>'Queued','sent'=>'Sent','failed'=>'Failed'])])
        ->recordActions([ViewAction::make(),EditAction::make()])
        ->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }
}

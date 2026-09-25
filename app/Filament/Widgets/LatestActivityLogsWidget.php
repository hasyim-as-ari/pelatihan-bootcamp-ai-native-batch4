<?php

namespace App\Filament\Widgets;

use App\Models\ActivityLog;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestActivityLogsWidget extends BaseWidget
{
    protected static ?int $sort = 4;

    protected static ?string $heading = 'Activity & Login History';

    protected ?string $description = 'User activity logs and system authentication events';

    protected int | string | array $columnSpan = [
        'md' => 1,
        'xl' => 1,
    ];

    public function table(Table $table): Table
    {
        return $table
            ->query(
                ActivityLog::query()
                    ->with('user')
                    ->latest('id')
            )
            ->columns([
                TextColumn::make('action_type')
                    ->label('Action')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'LOGIN' => 'success',
                        'LOGOUT' => 'gray',
                        'INSERT' => 'info',
                        'UPDATE' => 'warning',
                        'DELETE' => 'danger',
                        'PRINT' => 'purple',
                        'EXPORT' => 'teal',
                        'VIEW' => 'primary',
                        default => 'gray',
                    })
                    ->icon(fn (string $state): ?string => match ($state) {
                        'LOGIN' => 'heroicon-m-arrow-right-on-rectangle',
                        'LOGOUT' => 'heroicon-m-arrow-left-on-rectangle',
                        'INSERT' => 'heroicon-m-plus-circle',
                        'UPDATE' => 'heroicon-m-pencil-square',
                        'DELETE' => 'heroicon-m-trash',
                        'PRINT' => 'heroicon-m-printer',
                        'EXPORT' => 'heroicon-m-arrow-down-tray',
                        'VIEW' => 'heroicon-m-eye',
                        default => null,
                    }),

                TextColumn::make('user.name')
                    ->label('User')
                    ->default(fn ($record) => 'ID #' . $record->user_id)
                    ->description(fn ($record) => $record->user?->email ?? ('ID: ' . $record->user_id))
                    ->weight('bold')
                    ->searchable(),

                TextColumn::make('description')
                    ->label('Description & Module')
                    ->description(fn ($record) => '[' . $record->module_name . '] • IP: ' . $record->ip_address)
                    ->wrap()
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('Timestamp')
                    ->since()
                    ->sortable()
                    ->tooltip(fn ($record) => $record->created_at?->format('d/m/Y H:i:s')),
            ])
            ->filters([
                SelectFilter::make('action_type')
                    ->label('Action Type')
                    ->options([
                        'LOGIN' => 'LOGIN',
                        'LOGOUT' => 'LOGOUT',
                        'INSERT' => 'INSERT',
                        'UPDATE' => 'UPDATE',
                        'DELETE' => 'DELETE',
                        'PRINT' => 'PRINT',
                        'EXPORT' => 'EXPORT',
                        'VIEW' => 'VIEW',
                    ]),
            ])
            ->recordActions([
                Action::make('detail')
                    ->label('Detail')
                    ->icon('heroicon-m-eye')
                    ->color('gray')
                    ->modalHeading('Activity Log Detail')
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Close')
                    ->modalContent(fn (ActivityLog $record) => view('filament.components.activity-log-detail', [
                        'log' => $record,
                    ])),
            ])
            ->paginated([5, 10, 25])
            ->defaultPaginationPageOption(5)
            ->poll('30s');
    }
}

<?php

namespace App\Filament\Resources\Orders\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order_code')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('user.name')
                    ->label('Customer')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'confirmed' => 'info',
                        'preparing' => 'warning',
                        'ready' => 'success',
                        'completed' => 'success',
                        'cancelled' => 'danger',
                    }),
                TextColumn::make('total')
                    ->formatStateUsing(fn (string $state): string => 'Rp '.number_format($state, 0, ',', '.'))
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'preparing' => 'Preparing',
                        'ready' => 'Ready',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->recordActions([
                ViewAction::make(),
                Action::make('confirm')
                    ->label('Confirm')
                    ->action(fn ($record) => $record->update(['status' => 'confirmed']))
                    ->hidden(fn ($record) => $record->status !== 'pending'),
                Action::make('preparing')
                    ->label('Start Preparing')
                    ->action(fn ($record) => $record->update(['status' => 'preparing']))
                    ->hidden(fn ($record) => $record->status !== 'confirmed'),
                Action::make('ready')
                    ->label('Mark Ready')
                    ->action(fn ($record) => $record->update(['status' => 'ready']))
                    ->hidden(fn ($record) => $record->status !== 'preparing'),
                Action::make('complete')
                    ->label('Complete')
                    ->action(fn ($record) => $record->update(['status' => 'completed']))
                    ->hidden(fn ($record) => $record->status !== 'ready'),
                Action::make('cancel')
                    ->label('Cancel')
                    ->color('danger')
                    ->action(fn ($record) => $record->update(['status' => 'cancelled']))
                    ->hidden(fn ($record) => in_array($record->status, ['completed', 'cancelled'])),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

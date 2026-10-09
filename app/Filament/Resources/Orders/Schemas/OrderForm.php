<?php

namespace App\Filament\Resources\Orders\Schemas;

use App\Models\Menu;
use App\Models\User;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        $isCreate = request()->routeIs('filament.admin.resources.orders.create');

        return $schema
            ->components([
                TextInput::make('order_code')
                    ->required(fn () => $isCreate)
                    ->disabled(fn () => ! $isCreate),
                Select::make('user_id')
                    ->label('Customer')
                    ->options(User::pluck('name', 'id'))
                    ->required(fn () => $isCreate)
                    ->visible(fn () => $isCreate),
                TextInput::make('user.name')
                    ->label('Customer Name')
                    ->disabled()
                    ->visible(fn () => ! $isCreate),
                TextInput::make('user.email')
                    ->label('Email')
                    ->disabled()
                    ->visible(fn () => ! $isCreate),
                TextInput::make('user.phone')
                    ->label('Phone')
                    ->disabled()
                    ->visible(fn () => ! $isCreate),
                Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'preparing' => 'Preparing',
                        'ready' => 'Ready',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ])
                    ->required(fn () => $isCreate)
                    ->disabled(fn () => ! $isCreate),
                TextInput::make('created_at')
                    ->disabled()
                    ->visible(fn () => ! $isCreate),
                Repeater::make('items')
                    ->visible(fn () => $isCreate)
                    ->schema([
                        Select::make('menu_id')
                            ->label('Menu')
                            ->options(Menu::where('status', 'available')->pluck('name', 'id'))
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set) {
                                $menu = Menu::find($state);
                                if ($menu) {
                                    $set('category', $menu->category->name);
                                    $set('price', $menu->price);
                                }
                            }),
                        TextInput::make('category')
                            ->label('Category')
                            ->disabled()
                            ->dehydrated(false),
                        TextInput::make('quantity')
                            ->numeric()
                            ->required()
                            ->default(1),
                        TextInput::make('price')
                            ->label('Unit Price')
                            ->numeric()
                            ->disabled()
                            ->dehydrated(false),
                    ]),
                Repeater::make('items')
                    ->visible(fn () => ! $isCreate)
                    ->disabled()
                    ->schema([
                        TextInput::make('menu.name')
                            ->label('Menu')
                            ->disabled(),
                        TextInput::make('quantity')
                            ->disabled(),
                        TextInput::make('price')
                            ->disabled(),
                    ]),
                TextInput::make('subtotal')
                    ->numeric()
                    ->required(fn () => $isCreate)
                    ->disabled(fn () => ! $isCreate),
                TextInput::make('tax')
                    ->numeric()
                    ->default(0)
                    ->disabled(fn () => ! $isCreate),
                TextInput::make('total')
                    ->numeric()
                    ->required(fn () => $isCreate)
                    ->disabled(fn () => ! $isCreate),
                TextInput::make('notes')
                    ->disabled(fn () => ! $isCreate),
            ]);
    }
}

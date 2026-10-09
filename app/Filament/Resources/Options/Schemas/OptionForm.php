<?php

namespace App\Filament\Resources\Options\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class OptionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('type')
                    ->options([
                        'sugar' => 'Sugar',
                        'ice' => 'Ice',
                        'milk' => 'Milk',
                    ])
                    ->required(),
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('value')
                    ->required()
                    ->maxLength(50),
                TextInput::make('extra_fee')
                    ->numeric()
                    ->step(0.01)
                    ->default(0),
            ]);
    }
}

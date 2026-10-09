<?php

namespace App\Filament\Resources\Menus\Schemas;

use App\Models\Category;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Schema;

class MenuForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                Select::make('category_id')
                    ->options(Category::pluck('name', 'id'))
                    ->required()
                    ->label('Category'),
                Textarea::make('description'),
                TextInput::make('price')
                    ->numeric()
                    ->required()
                    ->step(0.01),
                FileUpload::make('image')
                    ->image()
                    ->directory('menus'),
                ToggleButtons::make('status')
                    ->options([
                        'available' => 'Available',
                        'unavailable' => 'Unavailable',
                    ])
                    ->default('available')
                    ->required(),
            ]);
    }
}

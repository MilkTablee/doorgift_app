<?php

namespace App\Filament\Resources\Orders\Infolists;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class OrderInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Order Information')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Select::make('customer_id')
                                    ->relationship('customer', 'name')
                                    ->disabled(),
                                Select::make('status')
                                    ->options([
                                        'pending' => 'Pending',
                                        'processing' => 'Processing',
                                        'shipped' => 'Shipped',
                                        'delivered' => 'Delivered',
                                        'cancelled' => 'Cancelled',
                                    ])
                                    ->disabled(),
                            ]),
                    ]),
                Section::make('Order Items')
                    ->schema([
                        Repeater::make('orderProducts')
                            ->relationship('orderProducts')
                            ->schema([
                                Select::make('product_id')
                                    ->relationship('product', 'name')
                                    ->disabled(),
                                Select::make('packaging_id')
                                    ->relationship('packaging', 'name')
                                    ->disabled(),
                                TextInput::make('quantity')
                                    ->disabled(),
                                TextInput::make('price')
                                    ->money('MYR')
                                    ->disabled(),
                            ])
                            ->columns(4)
                            ->disabled(),
                    ]),
                Section::make()
                    ->schema([
                        Grid::make(1)
                            ->schema([
                                TextInput::make('total_price')
                                ->money('MYR')
                                ->disabled(),
                            ]),
                    ]),
            ]);
    }
}

<?php

namespace App\Filament\Resources\Orders\Schemas;

use App\Models\Product;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Number;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                Select::make('customer_id')
                    ->relationship('customer', 'name')
                    ->searchable()
                    ->required(),

                Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'processing' => 'Processing',
                        'shipped' => 'Shipped',
                        'delivered' => 'Delivered',
                        'cancelled' => 'Cancelled',
                    ])
                    ->default('pending')
                    ->required(),

                Repeater::make('orderProducts')
                    ->relationship('orderProducts')
                    ->columnSpanFull()
                    ->schema([
                        Select::make('product_id')
                            ->label('Product')
                            ->options(Product::query()->pluck('name', 'id'))
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(fn ($state, Set $set, $livewire) => $set('price', Product::find($state)?->price ?? 0)),

                        TextInput::make('quantity')
                            ->numeric()
                            ->default(1)
                            ->required(),

                        TextInput::make('price')
                            ->numeric()
                            ->required(),
                    ])
                    ->live()
                    ->afterStateUpdated(function (Get $get, Set $set) {
                        self::updateTotalPrice($get, $set);
                    }),

                TextInput::make('total_price')
                    ->numeric()
                    ->prefix('MYR')
                    ->readOnly()
                    ->required(),
            ]);
    }

    public static function updateTotalPrice(Get $get, Set $set): void
    {
        $total = 0;

        if ($products = $get('products')) {
            foreach ($products as $product) {
                $total += $product['price'] * $product['quantity'];
            }
        }

        $set('total_price', Number::format($total, 2));
    }
}

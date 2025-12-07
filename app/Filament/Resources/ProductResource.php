<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use UnitEnum;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static UnitEnum|string|null $navigationGroup = 'Product Management';

    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Components\TextInput::make('name')
                    ->label(__('Nama'))
                    ->required()
                    ->maxLength(255),
                Components\Textarea::make('description')
                    ->label(__('Penerangan'))
                    ->columnSpanFull(),
                Components\TextInput::make('price')
                    ->label(__('Harga'))
                    ->required()
                    ->numeric()
                    ->prefix('MYR'),
                Components\FileUpload::make('image_path')
                    ->label(__('Gambar'))
                    ->image(),
                \Filament\Forms\Components\Toggle::make('is_visible')
                    ->label(__('Keterlihatan')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('Nama'))
                    ->searchable(),
                TextColumn::make('display_id')
                    ->label('ID'),
                TextColumn::make('price')
                    ->label(__('Harga'))
                    ->money('MYR')
                    ->sortable(),
                IconColumn::make('is_visible')
                    ->label(__('Keterlihatan'))
                    ->boolean()
                    ->sortable(),
                TextColumn::make('description')
                    ->label(__('Penerangan'))
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->label(__('Tarikh Dicipta'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label(__('Tarikh Diubah'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TernaryFilter::make('is_visible')
                    ->label(__('Keterlihatan'))
                    ->boolean()
                    ->trueLabel(__('Visible'))
                    ->falseLabel(__('Hidden')),

                Filter::make('price_range')
                    ->label(__('Julat Harga'))
                    ->form([
                        TextInput::make('price_from')
                            ->label(__('Dari'))
                            ->numeric()
                            ->inputMode('decimal')
                            ->prefix('MYR'),
                        TextInput::make('price_to')
                            ->label(__('Hingga'))
                            ->numeric()
                            ->inputMode('decimal')
                            ->prefix('MYR'),
                    ])
                    ->columns(2)
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['price_from'], fn (Builder $query, $price): Builder => $query->where('price', '>=', $price))
                            ->when($data['price_to'], fn (Builder $query, $price): Builder => $query->where('price', '<=', $price));
                    })->indicateUsing(function (array $data): ?string {
                        if (! $data['price_from'] && ! $data['price_to']) {
                            return null;
                        }

                        return __('Julat Harga').': '.($data['price_from'] ?? '0').' - '.($data['price_to'] ?? '...');
                    }),
                Filter::make('price_exact')
                    ->form([
                        TextInput::make('price')
                            ->label(__('Harga Tepat'))
                            ->numeric()
                            ->inputMode('decimal')
                            ->prefix('MYR'),
                    ])
                    ->query(fn (Builder $query, array $data): Builder => $query->when($data['price'], fn (Builder $query, $price): Builder => $query->where('price', $price)))
                    ->label(__('Harga Tepat')),
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->recordClasses(fn (Product $record): ?string => match ($record->is_visible) {
                false => 'hidden-product',
                default => null,
            });
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}

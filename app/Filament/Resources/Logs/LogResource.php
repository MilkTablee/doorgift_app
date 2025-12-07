<?php

namespace App\Filament\Resources\Logs;

use App\Filament\Resources\Logs\Pages\ListLogs;
use App\Models\Log;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use App\Filament\Resources\Logs\Tables\LogsTable;
use UnitEnum;

class LogResource extends Resource
{
    protected static ?string $model = Log::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $recordTitleAttribute = 'action';

    protected static string|UnitEnum|null $navigationGroup = 'User Management';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([]);
    }

    public static function table(Table $table): Table
    {
        return LogsTable::configure($table);
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
            'index' => ListLogs::route('/'),
        ];
    }
}

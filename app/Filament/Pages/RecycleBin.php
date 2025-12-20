<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use BackedEnum;
use Filament\Support\Icons\Heroicon;

class RecycleBin extends Page
{
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-trash';

    protected string $view = 'filament.pages.recycle-bin';

    protected static ?string $title = 'Recycle Bin';

    protected static ?int $navigationSort = 99;

    public static function getNavigationLabel(): string
    {
        return __('Recycle Bin');
    }
}

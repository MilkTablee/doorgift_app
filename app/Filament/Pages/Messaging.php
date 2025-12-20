<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use BackedEnum;
use Filament\Support\Icons\Heroicon;

class Messaging extends Page
{
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';

    protected string $view = 'filament.pages.messaging';

    protected static ?string $title = 'Messaging';

    protected static ?int $navigationSort = 2;

    public static function getNavigationLabel(): string
    {
        return __('Messaging');
    }
}

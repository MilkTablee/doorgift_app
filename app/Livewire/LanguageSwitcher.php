<?php

namespace App\Livewire;

use Livewire\Component;
use Filament\Support\Concerns\HasExtraAttributes;
use Illuminate\View\View;
use Illuminate\View\ComponentAttributeBag;

class LanguageSwitcher extends Component
{
    use HasExtraAttributes;

    public array $locales;

    public string $locale;

    public function mount(): void
    {
        $this->locales = [
            'en' => ['label' => 'English', 'icon' => 'flag-country-gb'],
            'ms' => ['label' => 'Bahasa Malaysia', 'icon' => 'flag-country-my'],
        ];
        $this->locale = session('locale', config('app.locale'));
    }

    public function render(): View
    {
        $attributes = $this->extraAttributes instanceof ComponentAttributeBag
            ? $this->extraAttributes
            : (new ComponentAttributeBag((array) $this->extraAttributes));

        return view('components.language-switcher', [
            'locales' => $this->locales,
            'locale' => $this->locale,
            'currentLocaleIcon' => $this->locales[$this->locale]['icon'] ?? null,
            'attributes' => $attributes,
        ]);
    }
}

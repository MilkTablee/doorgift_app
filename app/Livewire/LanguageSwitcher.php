<?php

namespace App\Livewire;

use Livewire\Component;

class LanguageSwitcher extends Component
{
    public array $locales;

    public string $locale;

    public function mount(): void
    {
        $this->locales = [
            'en' => 'English',
            'ms' => 'Bahasa Malaysia',
        ];
        $this->locale = session('locale', config('app.locale'));
    }

    public function switchLocale(string $locale): void
    {
        if (array_key_exists($locale, $this->locales)) {
            session()->put('locale', $locale);

            $this->redirect(request()->header('Referer'));
        }
    }

    public function render()
    {
        return view('livewire.language-switcher');
    }
}

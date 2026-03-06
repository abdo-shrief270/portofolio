<?php

namespace App\Livewire;

use Livewire\Component;

class LanguageSwitcher extends Component
{
    public string $currentLocale;

    public function mount()
    {
        $this->currentLocale = app()->getLocale();
    }

    public function switchLanguage(string $locale)
    {
        if (in_array($locale, ['en', 'ar'])) {
            session()->put('locale', $locale);
            $this->currentLocale = $locale;
            $this->redirect(request()->header('Referer', '/'));
        }
    }

    public function render()
    {
        return view('livewire.language-switcher');
    }
}

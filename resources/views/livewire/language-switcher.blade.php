<x-filament::dropdown placement="bottom-end">
    <x-slot name="trigger">
        <button
            class="flex items-center justify-center w-10 h-10 text-gray-500 rounded-full hover:bg-gray-500/5 focus:bg-gray-500/5 focus:outline-none dark:text-gray-400 dark:hover:bg-gray-900/50 dark:focus:bg-gray-900/50"
            aria-label="{{ __('Language') }}"
        >
            <x-heroicon-o-language class="w-5 h-5" />
        </button>
    </x-slot>

    <x-filament::dropdown.list>
        @foreach ($locales as $key => $label)
            <x-filament::dropdown.list.item
                wire:click="switchLocale('{{ $key }}')"
                :badge="strtoupper($key)"
                :badge-color="$locale === $key ? 'primary' : 'gray'"
            >
                {{ $label }}
            </x-filament::dropdown.list.item>
        @endforeach
    </x-filament::dropdown.list>
</x-filament::dropdown>
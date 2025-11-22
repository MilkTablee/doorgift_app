<x-filament::dropdown
    placement="bottom-end"
    teleport
    :attributes="$attributes->class(['fi-user-menu'])"
>
    <x-slot name="trigger">
        <button
            aria-label="{{ __('Switch Language') }}"
            type="button"
            class="fi-user-menu-trigger flex items-center gap-x-3 rounded-lg p-2 transition duration-75 hover:bg-gray-50 dark:hover:bg-white/5"
        >
            <div class="ms-3">
                <div class="text-sm font-medium text-gray-950 dark:text-white">
                    {{ strtoupper($locale) }}
                </div>
            </div>
        </button>
    </x-slot>

    <x-filament::dropdown.list>
        @foreach ($locales as $key => $label)
            <x-filament::dropdown.list.item
                :href="route('language-switcher.switch', ['locale' => $key])"
                tag="a"
                :active="$locale === $key"
            >
                {{ $label }}
            </x-filament::dropdown.list.item>
        @endforeach
    </x-filament::dropdown.list>
</x-filament::dropdown>
import preset from './vendor/filament/support/tailwind.config.preset.js'

export default {
    presets: [preset],
    content: [
        './app/Filament/**/*.php',
        './resources/views/filament/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
        './resources/css/filament/admin/theme.css',
        './resources/views/**/*.blade.php',
        './app/Livewire/**/*.php',
        './resources/views/components/language-switcher.blade.php',
    ],
    theme: {
        extend: {},
    },
    plugins: [],
}

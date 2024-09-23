import preset from './vendor/filament/support/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        './app/Filament/**/*.php',
        './vendor/filament/**/*.blade.php',
        './resources/views/**/*.blade.php',
    ],
}

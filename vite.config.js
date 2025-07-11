import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
// Если используешь Vite
import 'bootstrap';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});

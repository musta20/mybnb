import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/map.js',
                'resources/js/add-map.js',
                'resources/js/main.js',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});

import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss', 
                'resources/sass/system.scss', 
                'resources/sass/website.scss', 
                'resources/sass/guest.scss', 

                'resources/js/app.js',
                'resources/js/system.js',
                'resources/js/website.js',
                'resources/js/guest.js',
            ],
            refresh: true,
        }),
    ],
});

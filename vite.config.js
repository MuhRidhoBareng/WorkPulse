import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig(({ command }) => ({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    ...(command === 'serve' ? {
        server: {
            host: true,
            hmr: {
                host: '192.168.1.11',
            },
        },
    } : {}),
}));

import {defineConfig, loadEnv} from 'vite';
import laravel from 'laravel-vite-plugin';
import fs from 'fs';
import {resolve} from 'path';

export default defineConfig(({ command, mode }) => {
    process.env = {...process.env, ...loadEnv(mode, process.cwd(), '')};

    return {
        server: {
            host: true,
            hmr: {
                host: process.env.VITE_ASSET_HOST
            },
            https: process.env.VITE_APP_ENV !== 'local'
        },
        plugins: [
            laravel({
                input: ['resources/css/app.css', 'resources/js/app.js', 'resources/js/bootstrap.js'],
                refresh: true,
            }),
        ],
    }
});

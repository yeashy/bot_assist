import {defineConfig, loadEnv} from 'vite';
import laravel from 'laravel-vite-plugin';
import fs from 'fs';
import {resolve} from 'path';

export default defineConfig(({ command, mode }) => {
    process.env = {...process.env, ...loadEnv(mode, process.cwd(), '')};

    return {
        server: {
            https: process.env.VITE_APP_ENV !== 'local',
            host: '0.0.0.0',
            hmr: {
                host: 'localhost'
            },
        },
        plugins: [
            laravel({
                input: ['resources/css/app.css', 'resources/js/app.js'],
                refresh: true,
            }),
        ],
    }
});

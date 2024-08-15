import {defineConfig, loadEnv} from 'vite';
import laravel from 'laravel-vite-plugin';
import fs from 'fs';
import {resolve} from 'path';

export default defineConfig(({ command, mode }) => {
    process.env = {...process.env, ...loadEnv(mode, process.cwd(), '')};

    return {
        server: {
            hmr: {
                host: process.env.VITE_ASSET_HOST
            },
            https: process.env.VITE_APP_ENV !== 'local' ? {
                cert: fs.readFileSync(process.env.VITE_CERT_PATH),
                key: fs.readFileSync(process.env.VITE_KEY_PATH)
            } : false
        },
        plugins: [
            laravel({
                input: ['resources/css/app.css', 'resources/js/app.js'],
                refresh: true,
            }),
        ],
    }
});

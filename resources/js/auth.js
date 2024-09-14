function delay(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

document.addEventListener('DOMContentLoaded', (e) => {
    window.axios.interceptors.response.use(
        response => response,
        async error => {
            const originalRequest = error.config;

            if (!originalRequest._retry) {
                originalRequest._retry = true;

                if (error.response && error.response.status === 403) {
                    try {
                        await telegramAuth();

                        await delay(700);

                        return await window.axios(originalRequest);
                    } catch (e) {
                        console.log('Auth failed!');
                    }
                }
            }

            return Promise.reject(error);
        }
    )

    document.dispatchEvent(new Event('AxiosLoaded'));
});

async function telegramAuth() {
    const initData = window.Telegram.WebApp.initData;

    let params = Object.fromEntries(new URLSearchParams(initData));
    console.log(params);

    sendAuthRequest(params);
}

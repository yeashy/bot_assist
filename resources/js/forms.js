document.addEventListener('submit', function (e) {
    e.preventDefault();

    const form = e.target;

    const formData = new FormData(form);
    let json = {};
    formData.forEach((value, key) => {
        try {
            let parsedValue = JSON.parse(value);
            if (Array.isArray(parsedValue)) {
                json[key] = parsedValue;
                return;
            }
        } catch (e) {
            // Игнорируем ошибку, если это не JSON
        }

        if (!Reflect.has(json, key)) {
            json[key] = value;
            return;
        }

        if (!Array.isArray(json[key])) {
            json[key] = [json[key]];
        }

        json[key].push(value);
    });

    form.dispatchEvent(requested());

    window.axios.request({
        method: form.dataset.method ?? form.method,
        url: form.action,
        params: json
    })
        .then((response) => {
            form.dispatchEvent(submitted(response));
        })
        .catch((error) => {
            form.dispatchEvent(failed(error));
        })
        .finally((data) => {
            form.dispatchEvent(responded(data));
        });

});

const requested = (detail = {}) => {
    return new CustomEvent('requested', {detail: detail});
}

const submitted = (detail = {}) => {
    return new CustomEvent('submitted', {detail: detail});
};

const failed = (detail = {}) => {
    return new CustomEvent('error', {detail: detail});
};

const responded = (detail = {}) => {
    return new CustomEvent('responded', {detail: detail});
};


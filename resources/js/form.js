document.querySelectorAll('form').forEach((form) => {
    form.addEventListener('submit', (e) => {
        e.preventDefault();

        form.dispatchEvent(requested());

        axios.get(form.action, {})
            .then((response) => {
                form.dispatchEvent(submitted(response));
            })
            .catch((error) => {
                form.dispatchEvent(failed(error));
            })
            .finally((data) => {
                form.dispatchEvent(responded(data));
            })
    });
});

const requested = (detail = {}) => {
    return new CustomEvent('requested', { detail: detail });
}

const submitted = (detail = {}) => {
    return new CustomEvent('submitted', { detail: detail });
};

const failed = (detail = {}) => {
    return new CustomEvent('error', { detail: detail });
};

const responded = (detail = {}) => {
    return new CustomEvent('responded', { detail: detail });
};


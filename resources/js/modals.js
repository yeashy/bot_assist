document.addEventListener('click', (e) => {
    if (e.target.classList.contains('modal-toggle')) {
        const toggle = e.target;

        const modal = document.getElementById(toggle.dataset.modal);

        modal.classList.toggle('hidden');
        modal.dispatchEvent(toggled());
    }
});

document.querySelectorAll('.modal-close').forEach((toggle) => {
    toggle.addEventListener('click', (e) => {
        const modal = document.getElementById(toggle.dataset.modal);

        modal.classList.add('hidden');

        modal.dispatchEvent(opened());
        modal.dispatchEvent(toggled());
    });
});

document.querySelectorAll('.modal-open').forEach((toggle) => {
    toggle.addEventListener('click', (e) => {
        const modal = document.getElementById(toggle.dataset.modal);

        modal.classList.remove('hidden');

        modal.dispatchEvent(closed());
        modal.dispatchEvent(toggled());
    });
});

const opened = (detail = {}) => {
    return new CustomEvent('opened', { detail: detail });
}

const closed = (detail = {}) => {
    return new CustomEvent('closed', { detail: detail });
}

const toggled = (detail = {}) => {
    return new CustomEvent('toggled', { detail: detail });
}

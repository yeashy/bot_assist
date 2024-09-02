document.querySelectorAll('.phone-number').forEach((phoneInput) => {
    phoneInput.addEventListener('input', function () {
        let currentString = this.value.replace(/\D/g, ''); // Убираем все нецифровые символы

        // Удаляем начальную семерку, если она есть (потому что мы добавим её позже)
        if (currentString.startsWith('7')) {
            currentString = currentString.substring(1);
        }

        // Применяем маску
        let newString = '+7 ';
        if (currentString.length > 0) {
            newString += '(' + currentString.substring(0, 3);
        }
        if (currentString.length >= 4) {
            newString += ') ' + currentString.substring(3, 6);
        }
        if (currentString.length >= 7) {
            newString += '-' + currentString.substring(6, 8);
        }
        if (currentString.length >= 9) {
            newString += '-' + currentString.substring(8, 10);
        }

        this.value = newString;
    });

    phoneInput.addEventListener('keydown', function (event) {
        const key = event.key;

        // Разрешаем использование клавиш управления
        if (!(key === 'ArrowLeft' || key === 'ArrowRight' || key === 'Backspace' || key === 'Tab')) {
            const currentString = this.value.replace(/\D/g, '');
            // Запрещаем ввод символов, если длина превышает количество цифр в маске
            if (currentString.length >= 11 && /[0-9]/.test(key)) {
                event.preventDefault();
            }
        }
    });
});

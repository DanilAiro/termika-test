let form = document.querySelector('form');
let area = form.getElementsByClassName('textarea');

form.onsubmit = function() {
    alert('Форма успешно отправлена!')

    localStorage.clear();
}

form.addEventListener('input', function(event) {
    const formData = new FormData(this);
    const formObject = {};

    formData.forEach((value, key) => {
        formObject[key] = value;
    });

    localStorage.setItem('textarea', area.value);
    localStorage.setItem('formData', JSON.stringify(formObject));
});

window.addEventListener('load', function() {
    const savedData = localStorage.getItem('formData');

    if (savedData) {
        const formObject = JSON.parse(savedData);

        Object.keys(formObject).forEach(key => {
            const input = document.querySelector(`[name="${key}"]`);

            if (input) {
                input.value = formObject[key];
            }
        });
    }
});
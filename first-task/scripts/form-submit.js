let form = document.querySelector('#form-feedback');
let area = form.getElementsByClassName('textarea');
let phone = form.querySelector('input[name="phone"]');

let maskOptions = {
    mask: '+{7}(000)000-00-00',
    lazy: false
} 
let mask = new IMask(phone, maskOptions);

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
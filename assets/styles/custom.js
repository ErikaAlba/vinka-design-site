let plus = document.querySelector('#plusButton')
let minus = document.querySelector('#minusButton')
let number = document.querySelector('#number')

minus.addEventListener('click', restar);
plus.addEventListener('click', sumar);

function restar() {
    if (parseInt(number.value) > 0) {
        number.value = parseInt(number.value) - 1;
    }
}
function sumar() {
    number.value = parseInt(number.value) + 1;
}

const inputs = document.querySelectorAll('.input-box')
const user_name = inputs[0]
const user_cpf = inputs[1]
const user_phone = inputs[2]
const user_address = inputs[3]
const user_profession = inputs[4]
const user_income = inputs[5]
const user_email = inputs[6]
const user_password = inputs[7]
const submit_button = document.querySelector('.submit-button')
const signForm = document.querySelector('form')

user_name.addEventListener('keydown', () => {setTimeout(() => {
    const element = user_name
    let inputValue = element.value
    const errorMessage = element.parentElement.children[1]
    console.log(inputValue);
    if (inputValue.length >= 10 && inputValue.length <= 255) {
        element.classList.remove('red-border')
        errorMessage.classList.add('hidden')
    } else {
        element.classList.add('red-border')
        errorMessage.classList.remove('hidden')
    }
}, 1)})

user_cpf.addEventListener('keydown', () => {setTimeout(() => {
    const element = user_cpf
    let inputValue = element.value
    const errorMessage = element.parentElement.children[1]
    if (inputValue.length === 11) {
        element.classList.remove('red-border')
        errorMessage.classList.add('hidden')
    } else {
        element.classList.add('red-border')
        errorMessage.classList.remove('hidden')
    }
}, 1)})

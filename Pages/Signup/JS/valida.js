function validate(input) {
    const inputType = input.dataset.type
    const inputDiv = input.parentElement.parentElement
    const errorMessage = inputDiv.querySelector('.error-message')

    if (validators[inputType]) {
        validators[inputType](input)
    }

    if (input.validity.valid) {
        inputDiv.classList.remove('input-div--error')
        errorMessage.classList.remove('error-message--active')
    } else {
        inputDiv.classList.add('input-div--error')
        errorMessage.classList.add('error-message--active')

        errorMessage.innerHTML = showErrorMessage(inputType, input)
    }
}

function showErrorMessage(inputType, input) {
    let msg = ''

    for (error of errorTypes) {
        if (input.validity[error]) {
            msg = errorMessages[inputType][error]
        }
    }

    return msg
}

function cpfValid(input) {
    const formatedCpf = input.value.replace(/\D/g, '') // Limpa o CPF e deixa apenas os digitos
    let msg = ''
    let multiplicator = 10

    if (repeatedCpf(formatedCpf) || !cpfDigitValidator(formatedCpf, multiplicator)) { // Funções no arquivo ./JS/cpfValidator
        msg = 'CPF inválido.'
    }

    input.value = cpfMask(formatedCpf)
    input.setCustomValidity(msg)
}

function phoneValid(input) {
    let v = input.value

    v=v.replace(/\D/g,""); //Remove tudo o que não é dígito
    v=v.replace(/^(\d{2})(\d)/g,"($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
    v=v.replace(/(\d)(\d{4})$/,"$1-$2"); //Coloca hífen entre o quarto e o quinto dígitos

    input.value = v
}

const validators = {
    cpf: input => cpfValid(input),
    phone:input => phoneValid(input)
}

const errorMessages = {
    name: {
        valueMissing: 'O campo não pode estar vazio.',
        tooShort: 'O tamanho mínimo é de 10 caracteres.',
        tooLong: 'O tamanho máximo é de 255 caracteres.'
    },
    cpf: {
        valueMissing: 'O campo não pode estar vazio.',
        customError: 'CPF inválido.'
    },
    phone: {
        valueMissing: 'O campo não pode estar vazio.',
        tooShort: 'O tamanho mínimo é de 10 números.',
        tooLong: 'O tamanho máximo é de 11 números.'
    },
    address: {
        valueMissing: 'O campo não pode estar vazio.'
    },
    profession: {
        valueMissing: 'O campo não pode estar vazio.'
    },
    income: {
        valueMissing: 'O campo não pode estar vazio.',
    },
    email: {
        valueMissing: 'O campo não pode estar vazio.',
        typeMismatch: 'Digite um e-mail válido.'
    },
    password: {
        valueMissing: 'O campo não pode estar vazio.',
        patternMismatch: 'A senha deve conter no mínimo: <br> <ul><li>Um número</li><li>Uma letra maiúscula</li><li>Uma letra minúscula</li><li>Um símbolo</li><li>Ter de 6 a 8 caracteres</li></ul>'
    }
}

const errorTypes = [
    'valueMissing',
    'tooShort',
    'tooLong',
    'typeMismatch',
    'stepMismatch',
    'patternMismatch',
    'customError',
]

const inputs = document.querySelectorAll('.input-box')

for (let input of inputs) {
    if (input.dataset.type === 'income') {
        input.addEventListener('focus', () => {
            SimpleMaskMoney.setMask(input, {
                prefix: 'R$ ',
                fixed: true,
                fractionDigits: 2,
                decimalSeparator: ',',
                thousandsSeparator: '.',
                cursor: 'move',
            })
        })
    }

    input.addEventListener('invalid', e => {
        e.preventDefault()
    })

    input.addEventListener('blur', () => {
        validate(input)
    })
}
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

    input.setCustomValidity(msg)
}

function incomeValid(input) {
    let inputVal = ((input.value).replace(/\D/g, '')) / 100
    let msg = ''
    console.log(inputVal);

    if (inputVal < 10) {
        // msg = ' '
    } 

    input.setCustomValidity(msg)
}

const validators = {
    cpf: input => cpfValid(input),
    income: input => incomeValid(input)
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
        customError: 'Sua renda deve ser de no mínimo R$ 10,00 e no máximo R$ 999.999,00'
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
                cursor: 'end',
            })
        })
    }

    if (input.dataset.type === 'cpf') {
        input.addEventListener('keypress', () => {
            cpfMask(input)
        })
    }

    if (input.dataset.type === 'phone') {
        input.addEventListener('keydown', () => {
            setTimeout(() => {
                phoneMask(input)
            },5)
        })
    }

    input.addEventListener('invalid', e => {
        e.preventDefault()
    })

    input.addEventListener('blur', () => {
        validate(input)
    })
}
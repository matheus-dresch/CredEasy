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
        errorMessage.innerHTML = showErrorMessage(input, inputType)
    }
}

function showErrorMessage(input, inputType) {
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

    if (inputVal < 100) {
        input.value = ''
        msg = ' '
    }

    input.setCustomValidity(msg)
}

function confirmPassValid(input) {
    const password = document.querySelector('.user_password').value
    const passwordConfirm = input.value
    let msg = ''

    if (passwordConfirm != password) {
        msg = 'invalido'
    }

    input.setCustomValidity(msg)
}

function cepFetch(input) {
    let cep = input.value
    cep = cep.replace(/\D/g, '')

    if (cep && cep.length === 8) {
        fetch(`https://viacep.com.br/ws/${cep}/json/`).then(
            response => response.json()
        ).then(
            data => {
                if (data.erro) {
                    input.setCustomValidity('invalido')
                    return
                }
                input.setCustomValidity('')
                fillCep(data)
                return
            }
        )

    }
}

function fillCep(data) {
    const stateInput = document.querySelector('.user_state')
    const cityInput = document.querySelector('.user_city')
    const districtInput = document.querySelector('.user_district')

    const state = data.uf
    const city = data.localidade
    const district = data.bairro

    stateInput.value = state
    cityInput.value = city
    districtInput.value = district != '' ? district : districtInput.value
}


const validators = {
    cpf: input => cpfValid(input),
    income: input => incomeValid(input),
    confirmpassword: input => confirmPassValid(input),
    cep: input => cepFetch(input)
}

const errorMessages = {
    name: {
        valueMissing: 'O campo de NOME não pode estar vazio.',
        tooShort: 'O tamanho mínimo é de 10 caracteres.',
        tooLong: 'O tamanho máximo é de 255 caracteres.'
    },
    cpf: {
        valueMissing: 'O campo não pode estar vazio.',
        customError: 'CPF inválido.'
    },
    phone: {
        valueMissing: 'O campo de TELEFONE não pode estar vazio.',
        tooShort: 'O tamanho mínimo é de 10 números.',
        tooLong: 'O tamanho máximo é de 11 números.'
    },
    profession: {
        valueMissing: 'O campo de PROFISSÃO não pode estar vazio.'
    },
    income: {
        customError: 'Sua renda deve ser de no mínimo R$ 100,00',
        valueMissing: 'O campo não pode estar vazio.',
    },
    email: {
        valueMissing: 'O campo de E-MAIL não pode estar vazio.',
        typeMismatch: 'Digite um e-mail válido.'
    },
    password: {
        valueMissing: 'O campo de SENHA não pode estar vazio.',
        patternMismatch: 'A senha deve conter no mínimo: <br> <ul><li>Um número</li><li>Uma letra maiúscula</li><li>Uma letra minúscula</li><li>Um símbolo</li><li>Ter de 6 a 8 caracteres</li></ul>'
    },
    confirmpassword: {
        valueMissing: 'O campo CONFIRMAR SENHA não pode estar vazio.',
        customError: 'As senhas não são iguais.',
    },
    cep: {
        valueMissing: 'O campo CEP não pode estar vazio.',
        customError: 'CEP inválido.'
    },
    district: {
        valueMissing: 'O campo BAIRRO não pode estar vazio'
    },
    road: {
        valueMissing: 'O campo RUA não pode estar vazio.'
    },
    housenumber: {
        valueMissing: 'O campo Nº DA CASA não pode estar vazio.'
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

const inputMasks = {
    cpf: input => cpfMask(input),
    phone: input => phoneMask(input),
    cep: input => cepMask(input),
}

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

    if (inputMasks[input.dataset.type]) {
        input.addEventListener('keypress', () => {
            setTimeout(() => {
                inputMasks[input.dataset.type](input)
            }, 5)
        })
    }

    input.addEventListener('invalid', e => {
        e.preventDefault()
    })

    if (input.dataset.type === 'cep') {
        input.addEventListener('blur', () => {
            validate(input)
        })
    }
}

const submitButton = document.querySelector('.submit-button')

submitButton.addEventListener('click', e => {
    for (let input of inputs) {
        validate(input)
    }
})
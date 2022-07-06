function cpfDigitValidator(cpf, multi) {
    if (multi >= 12) {
        return true
    }

    let startMulti = multi
    let soma = 0

    const cpfNoDigits = cpf.substr(0, multi - 1).split('')
    const cpfDigit = cpf.charAt(multi - 1)

    for (let i = 0; startMulti > 1; startMulti--) {
        soma = soma + cpfNoDigits[i] * startMulti
        i++
    }

    if (cpfDigit == confirmDigit(soma)) {
        return cpfDigitValidator(cpf, multi + 1)
    }

    return false
}

function confirmDigit(soma) {;
    let x = 11 - (soma % 11)

    if (x === 11 || x === 10) {
        return 0
    } else {
        return x
    }
}

function repeatedCpf(cpf) {
    const blacklist = [
        '00000000000',
        '11111111111',
        '22222222222',
        '33333333333',
        '44444444444',
        '55555555555',
        '66666666666',
        '77777777777',
        '88888888888',
        '99999999999',
    ]

    blacklist.forEach(x => {
        if (cpf === x) {
            return true
        }
    })
}
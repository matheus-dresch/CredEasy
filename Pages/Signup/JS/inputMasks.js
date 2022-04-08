function phoneMask(input) {
    let phone = input.value

    phone = phone.replace(/\D/g, "");
    phone = phone.replace(/^(\d{2})(\d)/, "($1) $2");
    phone = phone.replace(/\s(\d{1})/, " $1 ")
    phone = phone.replace(/(\d)(\d{4})$/, "$1-$2");

    input.value = phone
}

function cpfMask(input = '') {
    let cpf = input.value

    cpf = cpf.replace(/\D/g, '')

    cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2")
    cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2')
    cpf = cpf.replace(/(\d{3})(\d{1,2})/, '$1-$2')

    input.value = cpf
}
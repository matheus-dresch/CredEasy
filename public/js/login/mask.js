const cpfInput = document.querySelector('#cpf');

cpfInput.addEventListener('keypress', () => {
    let cpf = cpfInput.value

    cpf = cpf.replace(/\D/g, '')

    cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2")
    cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2')
    cpf = cpf.replace(/(\d{3})(\d{1,2})$/, '$1-$2')

    cpfInput.value = cpf
})

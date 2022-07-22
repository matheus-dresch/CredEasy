const botoes = document.querySelectorAll(".btn-filtro");
const emprestimos = document.querySelectorAll('.emprestimo');
const limpaFiltros = document.querySelector('.remover-filtros')

console.log(botoes);

for (let botao of botoes) {
    botao.addEventListener('click', () => {
        let statusBotao = botao.dataset.status;

        for (let emprestimo of emprestimos) {
            let statusEmprestimo = emprestimo.dataset.status;

            if (statusEmprestimo != statusBotao) {
                emprestimo.classList.add('d-none')
            } else {
                emprestimo.classList.remove('d-none')
            }
        }
    })
}

limpaFiltros.addEventListener('click', () => {
    emprestimos.forEach((emprestimo) => {
        emprestimo.classList.remove('d-none');
    })
})

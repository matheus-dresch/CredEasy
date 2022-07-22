const taxaJuros = document.querySelector('#taxa');
const valorParcelaDisplay = document.querySelector('#valor_parc')
const valorTotalDisplay = document.querySelector('#valor_total');

taxaJuros.addEventListener('change', () => {
    const valorTotal = valorEmprestimo * (taxaJuros.value / 100 + 1);
    const valorParcela = valorTotal / quantidadeParcelas

    valorParcelaDisplay.value = `${new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(valorParcela)}`;
    valorTotalDisplay.textContent = `${new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(valorTotal)}`;
})

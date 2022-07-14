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
}

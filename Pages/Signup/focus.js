const inputs = document.querySelectorAll('.input-box');

inputs.forEach(input => {
    input.addEventListener('focus', () => {
        input.parentElement.classList.add('label-after--active')
        console.log('d');
    })
    
    input.addEventListener('blur', () => {
        input.parentElement.classList.remove('label-after--active')
    })
})
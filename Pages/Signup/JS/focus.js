const inputArray = document.querySelectorAll('.input-box');

inputArray.forEach(input => {
    input.addEventListener('focus', () => {
        input.parentElement.classList.add('label-after--active')
    })
    
    input.addEventListener('blur', () => {
        input.parentElement.classList.remove('label-after--active')
    })
})
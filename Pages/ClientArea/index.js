const text_text = document.querySelector('.header-text--text')

function updateHours() {
    const date = new Date()
    const actualHour = date.getHours()

    if (actualHour > 18 || actualHour < 6) {
        text_text.innerText = 'Boa noite :)'
    } else if (actualHour >= 6 && actualHour < 12) {
        text_text.innerText = 'Bom dia :)'
    } else {
        text_text.innerText = 'Boa tarde :)'
    }
}

updateHours()
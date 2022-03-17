const text_text = document.querySelector('.header-text--text')
const text_hour = document.querySelector('.header-text--hour')

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

    text_hour.innerText = `${addZero(actualHour)}:${addZero(date.getMinutes())}`

    setInterval(updateHours, 10000)
}

updateHours()

function addZero(num) {
    if (num < 10) {
        return `0${num}`
    } else {
        return num
    }
}
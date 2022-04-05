const mobileMenuButton = document.querySelector('.mobile-menu-button')
const menuLateral = document.querySelector('.mobile-menu')

mobileMenuButton.addEventListener('click', () => {
    menuLateral.classList.toggle('mobile-menu--visible')
})
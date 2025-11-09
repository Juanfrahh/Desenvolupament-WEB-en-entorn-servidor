// ==== LÓGICA DEL MENÚ HAMBURGUESA ====
const hamburger = document.getElementById('hamburger');
const navMenu = document.getElementById('nav-menu');
const header = document.querySelector('.header');

hamburger.addEventListener('click', () => {
  navMenu.classList.toggle('active');
  header.classList.toggle('open');
});

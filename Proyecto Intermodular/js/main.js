// ==== LÓGICA DEL MENÚ HAMBURGUESA ====
const hamburger = document.getElementById('hamburger');
const navMenu = document.getElementById('nav-menu');
const header = document.querySelector('.header');

hamburger.addEventListener('click', () => {
  navMenu.classList.toggle('active');
  header.classList.toggle('open');
});

// Menú lateral
hamburger.addEventListener('click', () => {
  hamburger.classList.toggle('active');
  sideMenu.classList.toggle('active');
});

// Modo claro/oscuro
themeToggle.addEventListener('click', () => {
  document.body.classList.toggle('dark-mode');
  const isDark = document.body.classList.contains('dark-mode');
  themeToggle.textContent = isDark ? '🌙' : '🌞';
  localStorage.setItem('theme', isDark ? 'dark' : 'light');
});

// Cargar modo guardado
window.addEventListener('DOMContentLoaded', () => {
  const saved = localStorage.getItem('theme');
  if (saved === 'dark') {
    document.body.classList.add('dark-mode');
    themeToggle.textContent = '🌙';
  }
});

const hamburger = document.getElementById('hamburger');
const sideMenu = document.getElementById('side-menu');
const overlay = document.getElementById('overlay');
const themeToggle = document.getElementById('theme-toggle');

// Menú lateral
hamburger.addEventListener('click', () => {
  hamburger.classList.toggle('active');
  sideMenu.classList.toggle('active');
  overlay.classList.toggle('active');
});

// Cerrar menú al hacer clic fuera
overlay.addEventListener('click', () => {
  hamburger.classList.remove('active');
  sideMenu.classList.remove('active');
  overlay.classList.remove('active');
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

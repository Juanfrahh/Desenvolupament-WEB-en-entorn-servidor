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
// ===== MAPA Y GEOLOCALIZACIÓN =====
const map = L.map('map').setView([40.4168, -3.7038], 13); // Madrid por defecto
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  maxZoom: 19,
  attribution: '© OpenStreetMap'
}).addTo(map);

const locateBtn = document.getElementById('locate-btn');

locateBtn.addEventListener('click', () => {
  if (!navigator.geolocation) {
    alert('Tu navegador no soporta geolocalización.');
    return;
  }

  locateBtn.textContent = "📡 Localizando...";
  navigator.geolocation.getCurrentPosition(success, error);
});

function success(position) {
  const lat = position.coords.latitude;
  const lon = position.coords.longitude;
  map.setView([lat, lon], 15);
  L.marker([lat, lon]).addTo(map)
    .bindPopup("📍 Estás aquí")
    .openPopup();
  locateBtn.textContent = "📍 Usar mi ubicación";
}

function error() {
  alert('No se pudo obtener tu ubicación.');
  locateBtn.textContent = "📍 Usar mi ubicación";
}

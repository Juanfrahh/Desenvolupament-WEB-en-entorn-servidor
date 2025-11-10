// === MENÚ HAMBURGUESA ===
const menuToggle = document.getElementById('menu-toggle');
const nav = document.getElementById('nav');
menuToggle.addEventListener('click', () => {
  nav.classList.toggle('open');
});

// === MODO OSCURO / CLARO ===
const themeToggle = document.getElementById('theme-toggle');
themeToggle.addEventListener('change', () => {
  document.body.classList.toggle('dark');
});

// === MAPA ===
const map = L.map('map').setView([39.4699, -0.3763], 13); // Valencia por defecto
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  attribution: '&copy; OpenStreetMap contributors'
}).addTo(map);

// Marcador inicial
const marker = L.marker([39.4699, -0.3763]).addTo(map);
marker.bindPopup("Centro de Valencia").openPopup();

// === GEOLOCALIZACIÓN ===
const locateBtn = document.getElementById('locate-btn');
locateBtn.addEventListener('click', () => {
  if (!navigator.geolocation) {
    alert("Tu navegador no soporta GPS.");
    return;
  }
  navigator.geolocation.getCurrentPosition((pos) => {
    const { latitude, longitude } = pos.coords;
    map.setView([latitude, longitude], 15);
    L.marker([latitude, longitude]).addTo(map)
      .bindPopup("Tu ubicación actual").openPopup();
  }, () => {
    alert("No se pudo obtener tu ubicación.");
  });
});

// === PASOS INTERACTIVOS (CÓMO USAR LA APP) ===
const steps = document.querySelectorAll('.step-item');
const detailCards = document.querySelectorAll('.detail-card');
const progressFill = document.querySelector('.progress-fill');
const prevBtn = document.getElementById('prev-step');
const nextBtn = document.getElementById('next-step');
let currentStep = 1;

function updateSteps() {
  steps.forEach(s => s.classList.remove('active'));
  detailCards.forEach(card => card.style.display = 'none');
  steps[currentStep - 1].classList.add('active');
  detailCards[currentStep - 1].style.display = 'block';
  progressFill.style.width = ((currentStep - 1) / (steps.length - 1)) * 100 + '%';
}

nextBtn.addEventListener('click', () => {
  if (currentStep < steps.length) currentStep++;
  updateSteps();
});

prevBtn.addEventListener('click', () => {
  if (currentStep > 1) currentStep--;
  updateSteps();
});

// Modal de ejemplo
const modal = document.getElementById('how-modal');
const modalContent = document.getElementById('modal-content');
const modalClose = document.getElementById('modal-close');
document.querySelectorAll('.link-more').forEach(btn => {
  btn.addEventListener('click', (e) => {
    const step = e.target.dataset.step;
    modalContent.innerHTML = `<h2>Ejemplo del paso ${step}</h2><p>Este es un ejemplo ilustrativo para el paso ${step} del proceso.</p>`;
    modal.setAttribute('aria-hidden', 'false');
  });
});
modalClose.addEventListener('click', () => {
  modal.setAttribute('aria-hidden', 'true');
});

updateSteps();

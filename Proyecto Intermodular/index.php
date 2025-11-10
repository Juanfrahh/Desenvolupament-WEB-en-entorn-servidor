<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ParkEase</title>
  <link rel="stylesheet" href="css/styles.css">
  <!-- Cargar Leaflet para el mapa -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

</head>
<body>
  <!-- ===== HEADER ===== -->
  <header class="header">
    <div class="left-section">
      <button class="hamburger" id="hamburger" aria-label="Menú">
        <span></span><span></span><span></span>
      </button>
      <div class="logo-container">
        <img src="logo-png.png" alt="ParkEase Logo" class="logo" id="logo">
      </div>
    </div>

    <h1 class="page-title">ParkEase</h1>

    <div class="right-section">
      <button id="theme-toggle" class="theme-toggle" aria-label="Cambiar tema">🌞</button>
    </div>
  </header>

  <!-- ===== SECCIÓN HERO ===== -->
<section class="hero">
  <div class="hero-content">
    <h2>Encuentra tu aparcamiento en segundos</h2>
    <p>Reserva tu plaza fácilmente desde cualquier lugar con ParkEase.</p>
    <button class="cta-btn">Buscar aparcamiento</button>
  </div>
</section>

<!-- ===== SECCIÓN MAPA GPS ===== -->
<section class="map-section">
  <h2>Encuentra aparcamientos cerca de ti</h2>
  <p>Usa tu ubicación actual para descubrir los aparcamientos disponibles más cercanos.</p>
  <div id="map"></div>
  <button id="locate-btn">📍 Usar mi ubicación</button>
</section>

<!-- ===== SECCIÓN VENTAJAS ===== -->
<section class="features">
  <h2>Ventajas de usar ParkEase</h2>
  <div class="feature-list">
    <div class="feature">
      <h3>💡 Rápido</h3>
      <p>Encuentra plazas disponibles sin perder tiempo dando vueltas.</p>
    </div>
    <div class="feature">
      <h3>🔒 Seguro</h3>
      <p>Tus datos y tus pagos están completamente protegidos.</p>
    </div>
    <div class="feature">
      <h3>💰 Económico</h3>
      <p>Aprovecha tarifas más bajas con ParkEase Prime.</p>
    </div>
    <div class="feature">
      <h3>🌿 EcoFriendly</h3>
      <p>Ayuda a reducir las emisiones de CO₂.</p>
    </div>
  </div>
</section>

<!-- ===== SECCIÓN CÓMO FUNCIONA ===== -->
<section class="how-it-works">
  <h2>¿Cómo funciona ParkEase?</h2>
  <div class="steps">
    <div class="step">
      <img src="https://cdn-icons-png.flaticon.com/512/535/535239.png" alt="Encontrar destino">
      <h3>1. Encuentra tu destino</h3>
      <p>Elige tu destino y deja que ParkEase te guíe.</p>
    </div>
    <div class="step">
      <img src="https://cdn-icons-png.flaticon.com/512/64/64673.png" alt="Busca tu sitio">
      <h3>2. Busca tu lugar</h3>
      <p>Encuentra plazas disponibles cerca de tu destino.</p>
    </div>
    <div class="step">
      <img src="https://cdn-icons-png.flaticon.com/512/1584/1584891.png" alt="Reservar plaza">
      <h3>3. Reserva plaza</h3>
      <p>Selecciona y reserva tu plaza en segundos.</p>
    </div>
    <div class="step">
      <img src="https://cdn-icons-png.flaticon.com/512/2085/2085261.png" alt="Aparcar con tranquilidad">
      <h3>4. Aparca con tranquilidad</h3>
      <p>Llega, muestra tu código y disfruta del día sin preocupaciones.</p>
    </div>
  </div>
</section>

  <!-- ===== MENÚ LATERAL IZQUIERDO ===== -->
  <nav class="side-menu" id="side-menu">
    <div class="menu-header">
      <img src="logo-png.png" alt="ParkEase Logo" class="menu-logo">
      <h2>ParkEase</h2>
    </div>

    <ul class="menu-links">
      <li><a href="#">Inicio</a></li>
      <li><a href="#">Reservar</a></li>
      <li><a href="#">Mis Reservas</a></li>
      <li><a href="#">Mapa</a></li>
      <li><a href="#">Formas de Pago</a></li>
      <li><a href="#">Prime</a></li>
      <li><a href="#">Descargar</a></li>
      <li><a href="#">Iniciar Sesión</a></li>
    </ul>
  </nav>

<?php include './php/'

  <div id="overlay"></div>

  <script src="js/main.js"></script>
</body>
</html>

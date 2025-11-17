// ===============================
// 1️⃣ ESPERAR A QUE EL HTML ESTÉ CARGADO
// ===============================
// 'DOMContentLoaded' garantiza que el código JS se ejecute
// solo cuando todo el HTML esté completamente listo.
document.addEventListener('DOMContentLoaded', function() {
  // Seleccionamos el botón flotante y el footer por sus clases del HTML
  // <a href="#footer" class="btn-flotante">Descubre más...</a>
  // <footer id="footer" class="footer">...</footer>
  const boton = document.querySelector('.btn-flotante');
  const footer = document.querySelector('.footer');

  // ===============================
  // 2️⃣ CUANDO SE HACE CLIC EN EL BOTÓN
  // ===============================
  boton.addEventListener('click', function(e) {
    e.preventDefault(); // Evita el salto brusco al footer al hacer clic

    // Alternamos la clase "activo" tanto en el footer como en el botón
    // Esto cambia los estilos desde el CSS (color, visibilidad, etc.)
    footer.classList.toggle('activo');
    boton.classList.toggle('activo');

    // Cambiamos el texto del botón según su estado
    if (footer.classList.contains('activo')) {
      boton.textContent = 'X Cerrar';
    } else {
      boton.textContent = 'Descubre más...';
    }
  });
});

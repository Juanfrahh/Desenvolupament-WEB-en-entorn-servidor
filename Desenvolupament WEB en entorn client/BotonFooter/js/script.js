document.addEventListener('DOMContentLoaded', function() {
  const boton = document.querySelector('.btn-flotante');
  const footer = document.querySelector('.footer');

  boton.addEventListener('click', function(e) {
    e.preventDefault();

    // Alternamos la clase 'activo' tanto en el footer como en el botón
    footer.classList.toggle('activo');
    boton.classList.toggle('activo');

    // Cambiamos el texto según el estado
    if (footer.classList.contains('activo')) {
      boton.textContent = 'X Cerrar';
    } else {
      boton.textContent = 'Descubre más...';
    }
  });
});

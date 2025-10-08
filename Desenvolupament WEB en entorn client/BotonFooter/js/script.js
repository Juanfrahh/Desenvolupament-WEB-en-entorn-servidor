document.addEventListener('DOMContentLoaded', function() {
  const boton = document.querySelector('.btn-flotante');
  const footer = document.querySelector('.footer');

  boton.addEventListener('click', function(e) {
    e.preventDefault();
    footer.classList.toggle('activo');

    if (footer.classList.contains('activo')) {
      boton.textContent = 'X Cerrar';
      //cambiar color a rojo
        boton.style.backgroundColor = '#ff0000';
    } else {
      boton.textContent = 'Descubre más...';
    }
  });
});
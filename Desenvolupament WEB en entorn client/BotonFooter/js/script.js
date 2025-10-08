// Esperamos a que el DOM esté cargado
document.addEventListener("DOMContentLoaded", function() {
  const btnFooter = document.getElementById("btn-footer");
  const footer = document.getElementById("footer");

  // Ocultamos el footer inicialmente
  footer.style.display = "none";

  // Guardamos el color original del botón
  const colorOriginal = getComputedStyle(btnFooter).backgroundColor;

  // Añadimos el evento click
  btnFooter.addEventListener("click", function() {
    if (footer.style.display === "none") {
      // Mostrar footer
      footer.style.display = "block";
      // Cambiar color y texto del botón
      btnFooter.style.backgroundColor = "#ff9800"; // color de ejemplo (naranja)
      btnFooter.textContent = "Cerrar";
    } else {
      // Ocultar footer
      footer.style.display = "none";
      // Restaurar color y texto original
      btnFooter.style.backgroundColor = colorOriginal;
      btnFooter.textContent = "Descubre más...";
    }
  });
});

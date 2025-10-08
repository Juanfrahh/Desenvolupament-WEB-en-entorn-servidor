// Esperamos a que el DOM esté cargado
document.addEventListener("DOMContentLoaded", function() {
  const btnFooter = document.getElementById("btn-footer");
  const footer = document.getElementById("footer");

  // Ocultamos el footer inicialmente
  footer.style.display = "none";

  // Guardamos el color original del botón
  const colorOriginal = getComputedStyle(btnFooter).backgroundColor;

  // Añadimos el evento click
  btn-Footer.addEventListener("click", function() {
    if (footer.style.display === "none") {
      // Mostrar footer
      footer.style.display = "block";
      // Cambiar color y texto del botón
      btnFooter.style.backgroundColor = "#ff0000";
      btnFooter.textContent = "XCerrar";
    } else {
      // Ocultar footer
      footer.style.display = "none";
      // Restaurar color y texto original
      btnFooter.style.backgroundColor = colorOriginal;
      btnFooter.textContent = "Descubre más...";
    }
  });
});

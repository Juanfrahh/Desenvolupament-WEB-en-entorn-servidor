document.addEventListener("DOMContentLoaded", () => {
  const btnFooter = document.getElementById("btn-footer");
  const footer = document.getElementById("footer");

  // Ocultamos el footer al cargar
  footer.style.display = "none";

  // Guardamos el color original del botón
  const colorOriginal = getComputedStyle(btnFooter).backgroundColor;

  btnFooter.addEventListener("click", () => {
    // Si el footer está oculto, lo mostramos
    if (footer.style.display === "none" || footer.style.display === "") {
      footer.style.display = "block"; // lo muestra
      btnFooter.style.backgroundColor = "#ff0000"; // color al abrir
      btnFooter.textContent = "XCerrar";
    } 
    // Si está visible, lo ocultamos
    else {
      footer.style.display = "none";
      btnFooter.style.backgroundColor = colorOriginal;
      btnFooter.textContent = "Descubre más...";
    }
  });
});
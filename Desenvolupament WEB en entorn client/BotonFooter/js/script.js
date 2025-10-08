
document.addEventListener("DOMContentLoaded", () => {
  const btnFooter = document.getElementById("btn-footer");
  const footer = document.getElementById("footer");

  // Comprobamos que los elementos existen
  if (!btnFooter || !footer) {
    console.error("No se encontró el botón o el footer.");
    return;
  }

  // Aseguramos que esté oculto al principio
  footer.style.display = "none";

  // Guardamos el color original del botón
  const colorOriginal = getComputedStyle(btnFooter).backgroundColor;

  // Evento click
  btnFooter.addEventListener("click", (e) => {
    e.preventDefault(); // evita que salte al ancla

    if (footer.style.display === "none" || footer.style.display === "") {
      footer.style.display = "block";
      btnFooter.style.backgroundColor = "#ff9800";
      btnFooter.textContent = "Cerrar";
    } else {
      footer.style.display = "none";
      btnFooter.style.backgroundColor = colorOriginal;
      btnFooter.textContent = "Descubre más...";
    }
  });
});

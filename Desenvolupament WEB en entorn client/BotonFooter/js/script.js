document.addEventListener("DOMContentLoaded", () => {
  const btnFooter = document.getElementById("btn-footer");
  const footer = document.getElementById("footer");

  // Aseguramos que existen ambos elementos
  if (!btnFooter || !footer) {
    console.error("No se encontró el botón o el footer.");
    return;
  }

  // Ocultamos el footer al iniciar
  footer.style.display = "none";

  // Guardamos el color original del botón
  const colorOriginal = getComputedStyle(btnFooter).backgroundColor;

  // Añadimos el evento de clic
  btnFooter.addEventListener("click", (e) => {
    e.preventDefault(); // evita salto de ancla

    if (footer.style.display === "none" || footer.style.display === "") {
      footer.style.display = "block"; // lo muestra
      btnFooter.style.backgroundColor = "#ff0000"; // cambia color
      btnFooter.textContent = "XCerrar"; // cambia texto
    } else {
      footer.style.display = "none"; // lo oculta
      btnFooter.style.backgroundColor = colorOriginal; // restaura color
      btnFooter.textContent = "Descubre más..."; // restaura texto
    }
  });
});

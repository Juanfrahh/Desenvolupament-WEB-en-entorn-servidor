<script>
document.addEventListener("DOMContentLoaded", () => {
  const btnFooter = document.getElementById("btn-footer");
  const footer = document.getElementById("footer");

  btnFooter.addEventListener("click", (e) => {
    e.preventDefault(); // evita que el enlace salte

    footer.classList.toggle("visible");
    footer.classList.toggle("oculto");
    btnFooter.classList.toggle("activo");

    if (footer.classList.contains("visible")) {
      btnFooter.textContent = "Cerrar";
    } else {
      btnFooter.textContent = "Descubre más...";
    }
  });
});
</script>

// Seleccionamos los elementos del DOM
const contador = document.querySelector(".contador");
const barraFront = document.querySelector(".barraFront");

let progreso = 0;

// Intervalo que actualiza el progreso cada 50 ms
const intervalo = setInterval(() => {
  progreso++;

  // Actualizamos el texto y la barra
  contador.textContent = `${progreso}%`;
  barraFront.style.width = `${progreso}%`;

  // Cuando llega a 100 %, detenemos el intervalo
  if (progreso >= 100) {
    clearInterval(intervalo);
    contador.textContent = "Completado ✓";
  }
}, 50);

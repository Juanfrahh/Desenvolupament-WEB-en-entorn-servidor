const contador = document.querySelector(".contador");
const barraFront = document.querySelector(".barraFront");

let progreso = 0;

const intervalo = setInterval(() => {
  progreso++;

  contador.textContent = `${progreso}%`;
  barraFront.style.width = `${progreso}%`;

  // Cuando llega a 100 %, detenemos el intervalo
  if (progreso >= 100) {
    clearInterval(intervalo);
    contador.textContent = "100%";
  }
}, 50);

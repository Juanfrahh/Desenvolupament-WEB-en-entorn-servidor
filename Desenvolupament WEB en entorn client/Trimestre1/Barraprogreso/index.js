// ======================================================
// SELECCIÓN DE ELEMENTOS DEL DOM (HTML)
// ======================================================

// Selecciona el elemento del HTML que mostrará el número del progreso.
// Ejemplo de HTML relacionado: <span class="contador">0%</span>
const contador = document.querySelector(".contador");

// Selecciona el elemento que representa la parte visible de la barra de progreso.
// Ejemplo de HTML relacionado:
// <div class="barra">
//   <div class="barraFront"></div>
// </div>
const barraFront = document.querySelector(".barraFront");

// ======================================================
// INICIALIZACIÓN DE VARIABLES
// ======================================================

// Variable que almacenará el progreso actual (en porcentaje)
let progreso = 0;

// ======================================================
// FUNCIÓN PRINCIPAL: setInterval
// ======================================================
// setInterval ejecuta una función cada cierto tiempo (en milisegundos).
// En este caso, se ejecutará cada 50 ms para ir incrementando el progreso.
const intervalo = setInterval(() => {
  // Cada vez que se ejecuta el intervalo, se aumenta el progreso en 1%
  progreso++;

  // Actualizamos el texto del elemento .contador en el HTML (por ejemplo, “45%”)
  contador.textContent = `${progreso}%`;

  // Ajustamos el ancho de la barra visual .barraFront para que crezca en pantalla
  // (si el contenedor tiene width: 100%, la barra se va llenando poco a poco)
  barraFront.style.width = `${progreso}%`;

  // Cuando el progreso llega a 100, se detiene el intervalo
  if (progreso >= 100) {
    clearInterval(intervalo); // Detiene la ejecución repetitiva del setInterval

    // Aseguramos que el texto final muestre exactamente 100%
    contador.textContent = "100%";
  }
// El intervalo se ejecuta cada 50 milisegundos (0.05 segundos)
}, 50);

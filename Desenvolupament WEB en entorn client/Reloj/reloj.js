/* reloj.js */

// Configuración del evento (puedes cambiar la fecha y temática)
const EVENTO = {
    nombre: "Black Friday",
    fecha: new Date("2024-11-29T00:00:00"),
    tema: "black-friday" // Cambia a "navidad", "halloween", etc. para otros estilos
};

// Formatea los números a dos dígitos
function dosDigitos(num) {
    return num.toString().padStart(2, '0');
}

// Actualiza el reloj y la cuenta atrás
function actualizarReloj() {
    const ahora = new Date();
    const reloj = document.getElementById("reloj");
    const evento = document.getElementById("evento");
    const cuenta = document.getElementById("cuenta");

    // Hora actual
    const horas = dosDigitos(ahora.getHours());
    const minutos = dosDigitos(ahora.getMinutes());
    const segundos = dosDigitos(ahora.getSeconds());
    const dia = dosDigitos(ahora.getDate());
    const mes = dosDigitos(ahora.getMonth() + 1);
    const año = ahora.getFullYear();

    reloj.innerHTML = `
        <span class="digito">${horas}</span>:
        <span class="digito">${minutos}</span>:
        <span class="digito">${segundos}</span>
        <div class="fecha">${dia}/${mes}/${año}</div>
    `;

    // Evento y cuenta atrás
    evento.textContent = `Próximo evento: ${EVENTO.nombre} (${EVENTO.fecha.toLocaleDateString()})`;

    let diff = EVENTO.fecha - ahora;
    if (diff < 0) diff = 0;
    const dias = dosDigitos(Math.floor(diff / (1000 * 60 * 60 * 24)));
    const horasRest = dosDigitos(Math.floor((diff / (1000 * 60 * 60)) % 24));
    const minRest = dosDigitos(Math.floor((diff / (1000 * 60)) % 60));
    const segRest = dosDigitos(Math.floor((diff / 1000) % 60));

    cuenta.textContent = `Cuenta atrás: ${dias}d ${horasRest}h ${minRest}m ${segRest}s`;

    // Animación del marco cada segundo
    reloj.classList.remove("animar");
    void reloj.offsetWidth; // Reinicia animación
    reloj.classList.add("animar");
}

// Inicializa el reloj
document.addEventListener("DOMContentLoaded", () => {
    document.body.classList.add(EVENTO.tema); // Aplica tema
    setInterval(actualizarReloj, 1000);
    actualizarReloj();
});
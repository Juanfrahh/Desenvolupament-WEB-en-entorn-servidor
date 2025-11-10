function mostrarReloj() {
    const horaElemento = document.getElementById("hora");
    const fechaElemento = document.getElementById("fecha");
    const contenedor = document.getElementById("contenedor");

    const fecha = new Date();

    // === HORA ===
    let horas = fecha.getHours();
    let minutos = fecha.getMinutes();
    let segundos = fecha.getSeconds();

    horas = horas < 10 ? "0" + horas : horas;
    minutos = minutos < 10 ? "0" + minutos : minutos;
    segundos = segundos < 10 ? "0" + segundos : segundos;

    horaElemento.textContent = `${horas}:${minutos}:${segundos}`;

    // === FECHA ===
    const diasSemana = ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"];
    const meses = ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"];

    const diaSemana = diasSemana[fecha.getDay()];
    const dia = fecha.getDate();
    const mes = meses[fecha.getMonth()];

    fechaElemento.textContent = `${diaSemana}, ${dia} ${mes}`;

    // === ANIMACIÓN ===
    contenedor.classList.toggle("animar");

    // === CUENTA ATRÁS ===
    mostrarCuentaAtras();
}

function mostrarCuentaAtras() {
    // Fecha objetivo del evento (Navidad 2025)
    const fechaEvento = new Date(2025, 11, 25, 0, 0, 0);
    const ahora = new Date();
    const diferencia = fechaEvento - ahora;

    // Crear elemento si no existe
    let cuentaAtras = document.getElementById("cuentaAtras");
    if (!cuentaAtras) {
        cuentaAtras = document.createElement("div");
        cuentaAtras.id = "cuentaAtras";
        cuentaAtras.style.marginTop = "20px";
        cuentaAtras.style.fontFamily = "'Courier New', monospace";
        cuentaAtras.style.fontSize = "1.2em";
        cuentaAtras.style.color = "#0ff";
        cuentaAtras.style.textAlign = "center";
        document.getElementById("reloj").appendChild(cuentaAtras);
    }

    if (diferencia <= 0) {
        cuentaAtras.textContent = "🎄 ¡Feliz Navidad! 🎅";
        return;
    }

    const dias = Math.floor(diferencia / (1000 * 60 * 60 * 24));
    const horas = Math.floor((diferencia / (1000 * 60 * 60)) % 24);
    const minutos = Math.floor((diferencia / (1000 * 60)) % 60);
    const segundos = Math.floor((diferencia / 1000) % 60);

    cuentaAtras.textContent = `Cuenta atrás para Navidad: ${dias}d ${horas}h ${minutos}m ${segundos}s`;
}

// Actualizar cada segundo
setInterval(mostrarReloj, 1000);

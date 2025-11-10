// ===============================
// 1️⃣ FUNCIÓN PRINCIPAL: MOSTRAR RELOJ Y FECHA
// ===============================
function mostrarReloj() {
    // --- Relación con el HTML ---
    // <div id="hora"> → donde se muestra la hora actual
    // <div id="fecha"> → donde se muestra la fecha
    // <div id="contenedor"> → contenedor que se anima cada segundo
    const horaElemento = document.getElementById("hora");
    const fechaElemento = document.getElementById("fecha");
    const contenedor = document.getElementById("contenedor");

    // Obtenemos la fecha y hora actuales del sistema
    const fecha = new Date();

    // === HORA ===
    let horas = fecha.getHours();
    let minutos = fecha.getMinutes();
    let segundos = fecha.getSeconds();

    // Formatear con dos dígitos siempre (por ejemplo, 08:03:09)
    horas = horas < 10 ? "0" + horas : horas;
    minutos = minutos < 10 ? "0" + minutos : minutos;
    segundos = segundos < 10 ? "0" + segundos : segundos;

    // Mostrar hora en el div #hora
    horaElemento.textContent = `${horas}:${minutos}:${segundos}`;

    // === FECHA ===
    // Arrays para convertir números en nombres abreviados
    const diasSemana = ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"];
    const meses = ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"];

    // Obtenemos día y mes actuales
    const diaSemana = diasSemana[fecha.getDay()];
    const dia = fecha.getDate();
    const mes = meses[fecha.getMonth()];

    // Mostrar fecha en el div #fecha (ejemplo: Lun, 10 Nov)
    fechaElemento.textContent = `${diaSemana}, ${dia} ${mes}`;

    // === ANIMACIÓN DEL RELOJ ===
    // En el CSS hay una clase .animar que aplica un efecto visual
    // Cada segundo, alternamos (toggle) esa clase para crear el parpadeo
    contenedor.classList.toggle("animar");

    // === LLAMADA A LA CUENTA ATRÁS ===
    // También se actualiza cada segundo junto al reloj
    mostrarCuentaAtras();
}

// ===============================
// 2️⃣ FUNCIÓN PARA MOSTRAR LA CUENTA ATRÁS DEL EVENTO
// ===============================
function mostrarCuentaAtras() {
    // --- Creación dinámica de un contenedor para la cuenta atrás ---
    // Si el HTML original no lo tiene, se genera desde aquí.
    let cuentaAtras = document.getElementById("cuentaAtras");
    if (!cuentaAtras) {
        cuentaAtras = document.createElement("div");
        cuentaAtras.id = "cuentaAtras";
        cuentaAtras.style.marginTop = "20px";
        cuentaAtras.style.fontFamily = "'Courier New', monospace";
        cuentaAtras.style.fontSize = "1.2em";
        cuentaAtras.style.color = "#0ff";
        cuentaAtras.style.textAlign = "center";
        // Lo añadimos debajo del div principal #reloj
        document.getElementById("reloj").appendChild(cuentaAtras);
    }

    // --- FECHA DEL EVENTO ---
    // (Año, Mes (0-11), Día, Hora, Min, Seg)
    const fechaEvento = new Date(2025, 11, 25, 0, 0, 0); // 🎄 Navidad 2025
    const ahora = new Date();
    const diferencia = fechaEvento - ahora;

    // Si ya pasó el evento, mostramos mensaje festivo
    if (diferencia <= 0) {
        cuentaAtras.textContent = "🎄 ¡Feliz Navidad! 🎅";
        return;
    }

    // Convertimos la diferencia en días, horas, minutos y segundos
    const dias = Math.floor(diferencia / (1000 * 60 * 60 * 24));
    const horas = Math.floor((diferencia / (1000 * 60 * 60)) % 24);
    const minutos = Math.floor((diferencia / (1000 * 60)) % 60);
    const segundos = Math.floor((diferencia / 1000) % 60);

    // Mostramos la cuenta regresiva
    cuentaAtras.textContent = `Cuenta atrás para Navidad: ${dias}d ${horas}h ${minutos}m ${segundos}s`;
}

// ===============================
// 3️⃣ ACTUALIZACIÓN AUTOMÁTICA CADA SEGUNDO
// ===============================
// Relación con HTML:
// <body onload="mostrarReloj()"> inicia la primera llamada
// Luego, este intervalo mantiene la actualización constante
setInterval(mostrarReloj, 1000);

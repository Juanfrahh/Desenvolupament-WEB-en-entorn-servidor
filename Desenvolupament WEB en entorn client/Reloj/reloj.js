function mostrarReloj() {
    const horaElemento = document.getElementById("hora");
    const fechaElemento = document.getElementById("fecha");
    const contenedor = document.getElementById("contenedor");

    let fecha = new Date();

    // Obtener hora, minutos y segundos
    let horas = fecha.getHours();
    let minutos = fecha.getMinutes();
    let segundos = fecha.getSeconds();

    // Asegurar dos dígitos
    horas = horas < 10 ? "0" + horas : horas;
    minutos = minutos < 10 ? "0" + minutos : minutos;
    segundos = segundos < 10 ? "0" + segundos : segundos;

    // Mostrar hora
    horaElemento.textContent = `${horas}:${minutos}:${segundos}`;

    // Obtener día de la semana y mes
    let diasSemana = ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"];
    let meses = ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"];

    let diaSemana = diasSemana[fecha.getDay()];
    let dia = fecha.getDate();
    let mes = meses[fecha.getMonth()];

    // Mostrar fecha
    fechaElemento.textContent = `${diaSemana}, ${dia} ${mes}`;

    // Añadir animación cada segundo
    contenedor.classList.toggle("animar");
}

// Actualizar cada segundo
setInterval(mostrarReloj, 1000);

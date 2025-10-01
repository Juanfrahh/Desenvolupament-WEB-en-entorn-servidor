function mostrarReloj(){
    const reloj = document.querySelectorAll('.hora');
    

    let fecha1 = new Date(); 
    let horas = fecha1.getHours();
    let minutos = fecha1.getMinutes();
    let segundos = fecha1.getSeconds();
    let año = fecha1.getFullYear();

    if (horas < 10) horas = "0" + horas;
    if (minutos < 10) minutos = "0" + minutos;
    if (segundos < 10) segundos = "0" + segundos;

    let horaActual = horas + ":" + minutos + ":" + segundos;
    console.log(horaActual);
    hora.textContent = horaActual;

    const fecha = document.querySelectorAll('.fecha');

    let fechaActual = new Date();
    let dia = fechaActual.getDate();
    let mes = fechaActual.getMonth() + 1;


    diaSemana = fechaActual.getDay();
    switch (diaSemana) {
        case 0: diaSemana = "Dom"; break;
        case 1: diaSemana = "Lun"; break;
        case 2: diaSemana = "Mar"; break;
        case 3: diaSemana = "Mie"; break;
        case 4: diaSemana = "Jue"; break;
        case 5: diaSemana = "Vie"; break;
        case 6: diaSemana = "Sab"; break;
        default: break;
    }
    switch (mes) {
        case 1: mes = "Ene"; break;
        case 2: mes = "Feb"; break;
        case 3: mes = "Mar"; break;
        case 4: mes = "Abr"; break;
        case 5: mes = "May"; break;
        case 6: mes = "Jun"; break;
        case 7: mes = "Jul"; break;
        case 8: mes = "Ago"; break;
        case 9: mes = "Sep"; break;
        case 10: mes = "Oct"; break;    
        case 11: mes = "Nov"; break;
        case 12: mes = "Dic"; break;
        default: break;
    }
    let fechaActual = diaSemana + ", " + dia + " " + mes ;
    console.log(fechaCompleta);
    fecha.textContent = fechaCompleta;
}
setInterval(mostrarReloj, 1000);

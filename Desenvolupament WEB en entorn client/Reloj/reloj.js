function mostrarReloj(){
    const reloj = document.querySelectorAll('.hora');
    

    let fecha = new Date(); 
    let horas = fecha.getHours();
    let minutos = fecha.getMinutes();
    let segundos = fecha.getSeconds();
    let año = fecha.getFullYear();

    if (horas < 10) horas = "0" + horas;
    if (minutos < 10) minutos = "0" + minutos;
    if (segundos < 10) segundos = "0" + segundos;

    let horaActual = horas + ":" + minutos + ":" + segundos;
    console.log(horaActual);
    hora.textContent = horaActual;

    const fetxa = document.querySelectorAll('.fecha');

    let fechaActual = new Date();
    let dia = fechaActual.getDate();
    let mes = fechaActual.getMonth() + 1;
    let ano = fechaActual.getFullYear();

    diaSemana = fechaActual.getDay();

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
    let fechaCompleta =dia + "," + dia + " " + mes ;
    console.log(fechaCompleta);
    fecha.textContent = fechaCompleta;
}
setInterval(mostrarReloj, 1000);

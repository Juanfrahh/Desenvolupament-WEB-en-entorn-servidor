function mostrarReloj(){
    const reloj = document.querySelectorAll('.hora');
    //console.log(reloj);

    let fecha = new Date(); 
    let horas = fecha.getHours();
    let minutos = fecha.getMinutes();
    let segundos = fecha.getSeconds();
    let año = fecha.getFullYear();

    let horaActual = horas + ":" + minutos + ":" + segundos + " " + año;``;
    window.log(horaActual);

}

setInterval(mostrarReloj, 1000);
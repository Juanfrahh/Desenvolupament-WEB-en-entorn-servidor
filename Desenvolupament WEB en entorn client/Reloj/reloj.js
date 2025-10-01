function mostrarReloj(){
    const reloj = document.querySelectorAll('.hora');
    

    let fecha = new Date(); 
    let horas = fecha.getHours();
    let minutos = fecha.getMinutes();
    let segundos = fecha.getSeconds();
    let año = fecha.getFullYear();

    let horaActual = horas + ":" + minutos + ":" + segundos + " " + año;``;
    console.log(horaActual);
    horaA
}

setInterval(mostrarReloj, 1000);
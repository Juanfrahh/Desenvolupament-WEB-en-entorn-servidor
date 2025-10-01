function mostrarReloj(){
    const reloj = document.querySelectorAll('.hora');
    

    let fecha = new Date(); 
    let horas = fecha.getHours();
    let minutos = fecha.getMinutes();
    let segundos = fecha.getSeconds();
    let año = fecha.getFullYear();

    let horaActual = horas + ":" + minutos + ":" + segundos;
    console.log(horaActual);
    hora.textContent = horaActual;
}

function
setInterval(mostrarReloj, 1000);

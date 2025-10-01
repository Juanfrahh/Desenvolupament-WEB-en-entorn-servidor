function mostrarReloj(){
    const reloj = document.querySelectorAll('#hora'); 
    console.log(reloj);

    let fecha = new Date(); 
    let horas = fecha.getHours();
    let minutos = fecha.getMinutes();
    let segundos = fecha.getSeconds();

    let horaActual = `${horas}:${minutos}:${segundos}`;
    reloj.textContent = horaActual;

}

setInterval(mostrarReloj, 1000);
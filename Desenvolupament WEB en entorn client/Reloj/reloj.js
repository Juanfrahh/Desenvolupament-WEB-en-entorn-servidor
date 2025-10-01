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

function mostrarFecha(){
    const fecha = document.querySelectorAll('.fecha');
    let fechaActual = new Date();
    let dia = fechaActual.getDate();
    let mes = fechaActual.getMonth() + 1;
    let año = fechaActual.getFullYear();

setInterval(mostrarReloj, 1000);

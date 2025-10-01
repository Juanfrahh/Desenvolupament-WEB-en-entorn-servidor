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

    let fechaCompleta = dia + "/" + mes + "/" + año;
    console.log(fechaCompleta);
    fecha.textContent = fechaCompleta;
}
setInterval(mostrarReloj, 1000);

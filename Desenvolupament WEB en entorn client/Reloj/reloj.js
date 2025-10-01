function reloj(){
    let fecha = new Date(); 
    let horas = fecha.getHours();
    let minutos = fecha.getMinutes();
    let segundos = fecha.getSeconds();

    const reloj = document.querySelectorAll('.hora');
    let horaActual = `${horas}:${minutos}:${segundos}`;
    reloj.textContent = horaActual;

}
window.onload = function() {
    const reloj = document.createElement('div');
    reloj.id = 'reloj';
    reloj.style.width = '300px';
    reloj.style.margin = '50px auto';
    reloj.style.padding = '30px';
    reloj.style.textAlign = 'center';
    reloj.style.fontFamily = 'monospace';
    reloj.style.fontSize = '2em';
    reloj.style.border = '8px solid #3498db';
    reloj.style.borderRadius = '20px';
    reloj.style.transition = 'box-shadow 0.3s, border-color 0.3s';

    document.body.appendChild(reloj);

    function pad(num) {
        return num.toString().padStart(2, '0');
    }

    function mostrarFechaHora() {
        const ahora = new Date();
        const fecha = `${pad(ahora.getDate())}/${pad(ahora.getMonth()+1)}/${ahora.getFullYear()}`;
        const hora = `${pad(ahora.getHours())}:${pad(ahora.getMinutes())}:${pad(ahora.getSeconds())}`;
        reloj.textContent = `${fecha} ${hora}`;
    }

    function actualizar() {
        mostrarFechaHora();
        animarMarco();
    }

    actualizar();
    setInterval(actualizar, 1000);
};
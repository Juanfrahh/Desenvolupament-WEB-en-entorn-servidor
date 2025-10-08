document.addEventListener('DOMContentLoaded', function () {
    const boton = document.getElementById('descubre-mas');
    const footer = document.querySelector('footer');
    const cerrar = document.getElementById('cerrar-footer');

    if (footer) {
        footer.style.display = 'none';
    }

    if (boton) {
        boton.addEventListener('click', function () {
            if (footer) {
                footer.style.display = 'block';
            }
            boton.style.backgroundColor = '#007bff';
            boton.style.color = '#fff';
            boton.textContent = '¡Gracias por descubrir!';
            boton.disabled = true;
        });
    }

    if (cerrar) {
        cerrar.addEventListener('click', function () {
            if (footer) {
                footer.style.display = 'none';
            }
            boton.style.backgroundColor = ''; // Restaurar color original
            boton.style.color = '';
            boton.textContent = 'Descubre más…';
            boton.disabled = false;
        });
    }
});
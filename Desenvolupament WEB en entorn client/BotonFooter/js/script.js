// Espera a que el DOM esté completamente cargado
document.addEventListener('DOMContentLoaded', function () {
    // Selecciona el botón y el footer
    const boton = document.getElementById('descubre-mas');
    const footer = document.querySelector('footer');

    // Oculta el footer inicialmente
    if (footer) {
        footer.style.display = 'none';
    }

    // Maneja el click en el botón
    if (boton) {
        boton.addEventListener('click', function () {
            // Muestra el footer
            if (footer) {
                footer.style.display = 'block';
            }
            // Cambia el color y el texto del botón
            boton.style.backgroundColor = '#007bff'; // Ejemplo: azul
            boton.style.color = '#fff';
            boton.textContent = '¡Gracias por descubrir!';
            // Opcional: deshabilitar el botón para evitar más clics
            boton.disabled = true;
        });
    }
});
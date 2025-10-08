// Espera a que el DOM esté completamente cargado
document.addEventListener('DOMContentLoaded', function() {
    // Selecciona el botón y el footer
    const boton = document.getElementById('mostrarFooter');
    const footer = document.querySelector('footer');

    // Oculta el footer inicialmente
    footer.style.display = 'none';

    // Añade el evento click al botón
    boton.addEventListener('click', function() {
        footer.style.display = 'block';
    });
});
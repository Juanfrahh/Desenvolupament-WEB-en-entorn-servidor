// Suponiendo que tienes un botón con id "footer" y un footer con id "footer"
const btn = document.getElementById('btn-footer');
const footer = document.getElementById('footer');

btn.addEventListener('click', function() {
    // Alternar la visibilidad del footer
    footer.classList.toggle('abierto');

    // Cambiar el texto del botón
    if (footer.classList.contains('abierto')) {
        btn.textContent = 'XCerrar';
        //
    } else {
        btn.textContent = 'Descubre más...';
    }
});
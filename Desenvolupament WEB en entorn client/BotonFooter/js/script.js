

const btn = document.getElementById('btn-footer');
const footer = document.getElementById('footer');

btn.addEventListener('click', function() {
    // El footer debe de aparecer cuando le demos al boton con el id btn-footer.

    
    // Alternar la visibilidad del footer
    footer.classList.toggle('abierto');

    // Cambiar el texto del botón
    if (footer.classList.contains('abierto')) {
        btn.textContent = 'XCerrar';
        //Cambiar el color del botón
        btn.style.backgroundColor = '#ff0000'; // Cambia a rojo
    } else {
        btn.textContent = 'Descubre más...';
        btn.style.backgroundColor = '#ffffffff';
    }
});


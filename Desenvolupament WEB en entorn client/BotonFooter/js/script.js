// Espera a que el DOM esté cargado
document.addEventListener('DOMContentLoaded', function () {
    const btnDescubreMas = document.getElementById('btn-flotante');
    const footer = document.querySelector('#footer');

    // Oculta el footer al inicio
    if (footer) {
        footer.style.display = 'none';
    }

    if (btnDescubreMas && footer) {
        btnDescubreMas.addEventListener('click', function () {
            if (footer.style.display === 'none') {
                footer.style.display = 'block';
                btnDescubreMas.textContent = 'XCerrar';
                btnDescubreMas.style.backgroundColor = 'red';
                btnDescubreMas.style.color = 'white';
            } else {
                footer.style.display = 'none';
                btnDescubreMas.textContent = 'Descubre más';
                btnDescubreMas.style.backgroundColor = '';
                btnDescubreMas.style.color = '';
            }
        });
    }
});
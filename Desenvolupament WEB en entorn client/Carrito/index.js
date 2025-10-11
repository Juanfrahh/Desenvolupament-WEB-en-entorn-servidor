// ===== VARIABLES =====
const carrito = document.querySelector('#lista-carrito tbody');
const listaCursos = document.querySelector('#lista-cursos');
const vaciarCarritoBtn = document.querySelector('#vaciar-carrito');

let articulosCarrito = [];

// ===== EVENTOS =====
cargarEventListeners();

function cargarEventListeners() {
    // Agregar curso
    listaCursos.addEventListener('click', agregarCurso);

    // Eliminar curso
    carrito.addEventListener('click', eliminarCurso);

    // Vaciar carrito
    vaciarCarritoBtn.addEventListener('click', vaciarCarrito);
}

// ===== FUNCIONES =====

// 1️⃣ Agregar curso
function agregarCurso(e) {
    e.preventDefault();

    if (e.target.classList.contains('agregar-carrito')) {
        const cursoSeleccionado = e.target.parentElement.parentElement;
        leerDatosCurso(cursoSeleccionado);
    }
}

// Extraer info del curso y guardarla en objeto
function leerDatosCurso(curso) {
    const infoCurso = {
        imagen: curso.querySelector('img').src,
        titulo: curso.querySelector('h4').textContent,
        precio: curso.querySelector('.precio span').textContent,
        id: curso.querySelector('a').getAttribute('data-id'),
        cantidad: 1
    };

    // Revisa si ya existe en el carrito
    const existe = articulosCarrito.some(curso => curso.id === infoCurso.id);
    if (existe) {
        // Actualizar cantidad
        const cursos = articulosCarrito.map(curso => {
            if (curso.id === infoCurso.id) {
                curso.cantidad++;
                return curso;
            } else {
                return curso;
            }
        });
        articulosCarrito = [...cursos];
    } else {
        // Agrega el nuevo curso
        articulosCarrito = [...articulosCarrito, infoCurso];
    }

    carritoHTML();
}

// 2️⃣ Eliminar curso del carrito
function eliminarCurso(e) {
    if (e.target.classList.contains('borrar-curso')) {
        const cursoId = e.target.getAttribute('data-id');
        articulosCarrito = articulosCarrito.filter(curso => curso.id !== cursoId);
        carritoHTML();
    }
}

// 3️⃣ Vaciar carrito
function vaciarCarrito() {
    articulosCarrito = [];
    limpiarHTML();
}

function carritoHTML() {
    limpiarHTML();

    articulosCarrito.forEach(curso => {
        const { imagen, titulo, precio, cantidad, id } = curso;

        const row = document.createElement('tr');
        row.innerHTML = `
            <td><img src="${imagen}" width="100"></td>
            <td>${titulo}</td>
            <td>${precio}</td>
            <td>${cantidad}</td>
            <td><a href="#" class="borrar-curso" data-id="${id}"> X </a></td>
        `;
        carrito.appendChild(row);
    });
}

// Elimina los cursos del tbody
function limpiarHTML() {
    while (carrito.firstChild) {
        carrito.removeChild(carrito.firstChild);
    }
}

// index.js (nuevo - sustituye al anterior)

// Selectores
const carrito = document.querySelector('#lista-carrito tbody');
const listaCursos = document.querySelector('#lista-cursos');
const vaciarCarritoBtn = document.querySelector('#vaciar-carrito');

let articulosCarrito = [];

// Cargar listeners
cargarEventListeners();

function cargarEventListeners() {
    // Cuando agregas un curso
    listaCursos.addEventListener('click', agregarCurso);

    // Cuando eliminas un curso del carrito
    carrito.addEventListener('click', eliminarCurso);

    // Cuando vacías el carrito (prevenir comportamiento por defecto del enlace)
    vaciarCarritoBtn.addEventListener('click', (e) => {
        e.preventDefault();
        vaciarCarrito();
    });

    // Al cargar el DOM, recuperar carrito desde localStorage
    document.addEventListener('DOMContentLoaded', () => {
        articulosCarrito = obtenerCarritoLocalStorage();
        carritoHTML();
    });
}

function agregarCurso(e) {
    e.preventDefault();

    if (e.target.classList.contains('agregar-carrito')) {
        const cursoSeleccionado = e.target.parentElement.parentElement;
        leerDatosCurso(cursoSeleccionado);
    }
}

function leerDatosCurso(curso) {
    const infoCurso = {
        imagen: curso.querySelector('img').src,
        titulo: curso.querySelector('h4').textContent,
        precio: curso.querySelector('.precio span') ? curso.querySelector('.precio span').textContent : curso.querySelector('.precio').textContent,
        id: curso.querySelector('a').getAttribute('data-id'),
        cantidad: 1
    };

    // Comprobar si ya existe en el carrito
    const existe = articulosCarrito.some(curso => curso.id === infoCurso.id);

    if (existe) {
        // Incrementar cantidad
        articulosCarrito = articulosCarrito.map(curso => {
            if (curso.id === infoCurso.id) {
                return {
                    ...curso,
                    cantidad: curso.cantidad + 1
                };
            } else {
                return curso;
            }
        });
    } else {
        // Añadir nuevo curso
        articulosCarrito = [...articulosCarrito, infoCurso];
    }

    // Renderizar y guardar en storage
    carritoHTML();
    guardarCarritoLocalStorage();
}

function eliminarCurso(e) {
    if (e.target.classList.contains('borrar-curso')) {
        e.preventDefault();
        const cursoId = e.target.getAttribute('data-id');
        articulosCarrito = articulosCarrito.filter(curso => curso.id !== cursoId);
        carritoHTML();
        guardarCarritoLocalStorage();
    }
}

function vaciarCarrito() {
    articulosCarrito = [];
    limpiarHTML();
localStorage.removeItem('carrito');
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

function limpiarHTML() {
    while (carrito.firstChild) {
        carrito.removeChild(carrito.firstChild);
    }
}

function guardarCarritoLocalStorage() {
    localStorage.setItem('carrito', JSON.stringify(articulosCarrito));
}

function obtenerCarritoLocalStorage() {
    const carritoLS = localStorage.getItem('carrito');
    return carritoLS ? JSON.parse(carritoLS) : [];
}

const carrito = document.querySelector('#lista-carrito tbody');
const listaCursos = document.querySelector('#lista-cursos');
const vaciarCarritoBtn = document.querySelector('#vaciar-carrito');

let articulosCarrito = [];

cargarEventListeners();

function cargarEventListeners() {
    listaCursos.addEventListener('click', agregarCurso);

    carrito.addEventListener('click', eliminarCurso);

    vaciarCarritoBtn.addEventListener('click', (e) => {
        e.preventDefault();
        vaciarCarrito();
    });

    document.addEventListener('DOMContentLoaded', () => {
        articulosCarrito = obtenerCarritoLocalStorage();
        carritoHTML();
    });// Seleccionamos elementos del DOM que vamos a necesitar
const carrito = document.querySelector('#lista-carrito tbody'); // Cuerpo de la tabla donde se muestran los cursos en el carrito
const listaCursos = document.querySelector('#lista-cursos'); // Lista de cursos disponibles
const vaciarCarritoBtn = document.querySelector('#vaciar-carrito'); // Botón para vaciar el carrito

// Array donde almacenaremos los cursos añadidos al carrito
let articulosCarrito = [];

// Función que agrega los event listeners al cargar la página
cargarEventListeners();

function cargarEventListeners() {
    // Cuando se hace click en un curso (para agregar al carrito)
    listaCursos.addEventListener('click', agregarCurso);

    // Cuando se hace click en el carrito (para eliminar un curso)
    carrito.addEventListener('click', eliminarCurso);

    // Cuando se hace click en el botón de vaciar carrito
    vaciarCarritoBtn.addEventListener('click', (e) => {
        e.preventDefault(); // Prevenimos el comportamiento por defecto (si es un <a> o <button>)
        vaciarCarrito(); // Llamamos a la función para vaciar el carrito
    });

    // Al cargar el documento, obtenemos los cursos del localStorage para mantener el carrito persistente
    document.addEventListener('DOMContentLoaded', () => {
        articulosCarrito = obtenerCarritoLocalStorage(); // Recuperamos carrito guardado en localStorage
        carritoHTML(); // Mostramos los cursos en la tabla
    });
}

// Función que maneja la acción de agregar un curso al carrito
function agregarCurso(e) {
    e.preventDefault(); // Prevenimos la acción por defecto del enlace

    // Verificamos si el elemento clickeado tiene la clase 'agregar-carrito'
    if (e.target.classList.contains('agregar-carrito')) {
        const cursoSeleccionado = e.target.parentElement.parentElement; // Obtenemos el elemento que contiene toda la info del curso
        leerDatosCurso(cursoSeleccionado); // Pasamos el curso para extraer sus datos
    }
}

// Función que extrae los datos del curso seleccionado
function leerDatosCurso(curso) {
    const infoCurso = {
        imagen: curso.querySelector('img').src, // Imagen del curso
        titulo: curso.querySelector('h4').textContent, // Título del curso
        precio: curso.querySelector('.precio span') ? curso.querySelector('.precio span').textContent : curso.querySelector('.precio').textContent, // Precio (si está dentro de un span o directamente)
        id: curso.querySelector('a').getAttribute('data-id'), // ID del curso
        cantidad: 1 // Cantidad inicial
    };

    // Verificamos si el curso ya está en el carrito
    const existe = articulosCarrito.some(curso => curso.id === infoCurso.id);

    if (existe) {
        // Si ya existe, incrementamos la cantidad
        articulosCarrito = articulosCarrito.map(curso => {
            if (curso.id === infoCurso.id) {
                return {
                    ...curso, // Mantenemos los demás datos
                    cantidad: curso.cantidad + 1 // Sumamos 1 a la cantidad
                };
            } else {
                return curso; // Si no es el mismo curso, lo dejamos igual
            }
        });
    } else {
        // Si no existe, lo agregamos al carrito
        articulosCarrito = [...articulosCarrito, infoCurso];
    }

    carritoHTML(); // Actualizamos el HTML del carrito
    guardarCarritoLocalStorage(); // Guardamos el carrito en localStorage
}

// Función que elimina un curso del carrito
function eliminarCurso(e) {
    if (e.target.classList.contains('borrar-curso')) { // Si se clickeó en el botón de borrar
        e.preventDefault();
        const cursoId = e.target.getAttribute('data-id'); // Obtenemos el ID del curso a eliminar
        articulosCarrito = articulosCarrito.filter(curso => curso.id !== cursoId); // Filtramos el array sin el curso eliminado
        carritoHTML(); // Actualizamos el HTML
        guardarCarritoLocalStorage(); // Actualizamos el localStorage
    }
}

// Función que vacía completamente el carrito
function vaciarCarrito() {
    articulosCarrito = []; // Limpiamos el array
    limpiarHTML(); // Limpiamos el HTML
    localStorage.removeItem('carrito'); // Eliminamos del localStorage
}

// Función que genera el HTML del carrito dinámicamente
function carritoHTML() {
    limpiarHTML(); // Limpiamos el contenido previo para evitar duplicados

    // Recorremos los cursos en el carrito y los mostramos
    articulosCarrito.forEach(curso => {
        const { imagen, titulo, precio, cantidad, id } = curso;

        const row = document.createElement('tr'); // Creamos una fila de tabla
        row.innerHTML = `
            <td><img src="${imagen}" width="100"></td>
            <td>${titulo}</td>
            <td>${precio}</td>
            <td>${cantidad}</td>
            <td><a href="#" class="borrar-curso" data-id="${id}"> X </a></td>
        `;
        carrito.appendChild(row); // Añadimos la fila al tbody del carrito
    });
}

// Función que limpia todo el HTML del carrito
function limpiarHTML() {
    while (carrito.firstChild) {
        carrito.removeChild(carrito.firstChild); // Eliminamos cada hijo del tbody
    }
}

// Función que guarda el carrito en localStorage
function guardarCarritoLocalStorage() {
    localStorage.setItem('carrito', JSON.stringify(articulosCarrito));
}

// Función que obtiene el carrito desde localStorage
function obtenerCarritoLocalStorage() {
    const carritoLS = localStorage.getItem('carrito');
    return carritoLS ? JSON.parse(carritoLS) : []; // Retornamos el array, o vacío si no existe
}

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

    const existe = articulosCarrito.some(curso => curso.id === infoCurso.id);

    if (existe) {
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
        articulosCarrito = [...articulosCarrito, infoCurso];
    }

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

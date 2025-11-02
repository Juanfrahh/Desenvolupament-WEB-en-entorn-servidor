// Selectores
const formulario = document.querySelector('#formulario');
const resultado = document.querySelector('#resultado');
const paginacionDiv = document.querySelector('#paginacion');

// Variables globales
const registrosPorPagina = 40;
let totalPaginas;
let iterador;
let paginaActual = 1;

// EVENTOS
formulario.addEventListener('submit', validarFormulario);

// ---------------- FUNCIONES PRINCIPALES ----------------

// Validar formulario
function validarFormulario(e) {
  e.preventDefault();
  const terminoBusqueda = document.querySelector('#termino').value.trim();

  if (terminoBusqueda === '') {
    mostrarError('❌ El campo no puede estar vacío');
    return;
  }

  // Llamar a la API
  buscarImagenes(terminoBusqueda);
}

// Mostrar mensaje de error (no acumulable)
function mostrarError(mensaje) {
  const existe = document.querySelector('.error');
  if (existe) existe.remove();

  const alerta = document.createElement('p');
  alerta.textContent = mensaje;
  alerta.classList.add('error', 'bg-red-500', 'text-white', 'text-center', 'p-2', 'rounded', 'mt-4');

  formulario.appendChild(alerta);

  setTimeout(() => alerta.remove(), 2000);
}

// Consultar API de Pixabay
async function buscarImagenes(termino) {
  const key = 'TU_API_KEY_AQUI';
  const url = `https://pixabay.com/api/?key=${key}&q=${termino}&per_page=${registrosPorPagina}&page=${paginaActual}`;

  try {
    const respuesta = await fetch(url);
    const datos = await respuesta.json();

    totalPaginas = calcularPaginas(datos.totalHits);
    mostrarImagenes(datos.hits);
  } catch (error) {
    console.error('Error al obtener imágenes', error);
  }
}

// Calcular número total de páginas
function calcularPaginas(total) {
  return Math.ceil(total / registrosPorPagina);
}

// Mostrar imágenes en pantalla
function mostrarImagenes(imagenes) {
  limpiarHTML(resultado);
  limpiarHTML(paginacionDiv);

  if (imagenes.length === 0) {
    mostrarError('No se encontraron resultados');
    return;
  }

  // Recorrer imágenes
  imagenes.forEach(imagen => {
    const { previewURL, likes, views, largeImageURL } = imagen;

    const contenedor = document.createElement('div');
    contenedor.classList.add('w-1/2', 'md:w-1/3', 'lg:w-1/4', 'mb-4', 'p-3');

    const card = document.createElement('div');
    card.classList.add('bg-white');

    const img = document.createElement('img');
    img.src = previewURL;
    img.classList.add('w-full');

    const info = document.createElement('div');
    info.classList.add('p-4');

    const likesP = document.createElement('p');
    likesP.innerHTML = `<span class="font-bold">${likes}</span> <span class="font-light">Me gusta</span>`;

    const viewsP = document.createElement('p');
    viewsP.innerHTML = `<span class="font-bold">${views}</span> <span class="font-light">Vistas</span>`;

    const enlace = document.createElement('a');
    enlace.href = largeImageURL;
    enlace.target = '_blank';
    enlace.textContent = 'Ver imagen';
    enlace.classList.add(
      'block', 'w-full', 'bg-blue-800', 'hover:bg-blue-500', 'text-white',
      'uppercase', 'font-bold', 'text-center', 'rounded', 'mt-5', 'p-1'
    );

    info.appendChild(likesP);
    info.appendChild(viewsP);
    info.appendChild(enlace);

    card.appendChild(img);
    card.appendChild(info);
    contenedor.appendChild(card);

    resultado.appendChild(contenedor);
  });

  // Generar paginador
  imprimirPaginador();
}

// Limpiar resultados anteriores
function limpiarHTML(elemento) {
  while (elemento.firstChild) {
    elemento.removeChild(elemento.firstChild);
  }
}

function *crearPaginador(total) {
  for (let i = 1; i <= total; i++) {
    yield i;
  }
}

function imprimirPaginador() {
  iterador = crearPaginador(totalPaginas);

  limpiarHTML(paginacionDiv);

  while (true) {
    const { value, done } = iterador.next();
    if (done) return;

    // Crear botón por cada página
    const boton = document.createElement('a');
    boton.href = '#';
    boton.dataset.pagina = value;
    boton.textContent = value;
    boton.classList.add(
      'siguiente', 'bg-yellow-400', 'px-4', 'py-1', 'mr-2',
      'font-bold', 'mb-4', 'rounded', 'hover:bg-yellow-500'
    );

    boton.onclick = () => {
      paginaActual = value;
      const termino = document.querySelector('#termino').value.trim();
      buscarImagenes(termino);
    };

    paginacionDiv.appendChild(boton);
  }
}

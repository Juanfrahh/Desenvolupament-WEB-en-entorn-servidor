// Seleccionamos elementos clave del DOM
const formulario = document.querySelector('#formulario');
const resultado = document.querySelector('#resultado');
const paginacionDiv = document.querySelector('#paginacion');

// Variables globales
const registrosPorPagina = 40; // Número de imágenes por página
let totalPaginas;              // Total de páginas (calculadas según los resultados)
let iterador;                  // Iterador generado para la paginación
let paginaActual = 1;          // Página actual que se está mostrando

// ----------------------------------------------------
// EVENTO PRINCIPAL
// ----------------------------------------------------
// Cuando el usuario envía el formulario de búsqueda
formulario.addEventListener('submit', validarFormulario);

/* =====================================================
   FUNCIÓN: validarFormulario()
   -----------------------------------------------------
   - Previene el comportamiento por defecto del formulario.
   - Valida que el campo de búsqueda no esté vacío.
   - Si es válido, inicia la búsqueda de imágenes.
===================================================== */
function validarFormulario(e) {
  e.preventDefault();

  const terminoBusqueda = document.querySelector('#termino').value.trim();

  if (terminoBusqueda === '') {
    // Si el usuario no escribió nada, mostramos un error
    mostrarError('El campo no puede estar vacío');
    return;
  }

  // Iniciamos la búsqueda con el término introducido
  buscarImagenes(terminoBusqueda);
}

/* =====================================================
   FUNCIÓN: mostrarError()
   -----------------------------------------------------
   - Muestra un mensaje de error visual bajo el formulario.
   - Evita duplicar mensajes si ya hay uno visible.
   - El mensaje desaparece automáticamente a los 2 segundos.
===================================================== */
function mostrarError(mensaje) {
  const existe = document.querySelector('.error');
  if (existe) existe.remove(); // Si ya hay una alerta, la eliminamos

  const alerta = document.createElement('p');
  alerta.textContent = mensaje;
  alerta.classList.add(
    'error',
    'bg-red-500',
    'text-white',
    'text-center',
    'p-2',
    'rounded',
    'mt-4'
  );

  formulario.appendChild(alerta);

  setTimeout(() => alerta.remove(), 2000);
}

/* =====================================================
   FUNCIÓN ASÍNCRONA: buscarImagenes()
   -----------------------------------------------------
   - Llama a la API de Pixabay usando Fetch.
   - Muestra los resultados y genera el paginador.
===================================================== */
async function buscarImagenes(termino) {
  // Clave de acceso de la API de Pixabay
  const key = '53059380-55c86030302e17d17eb7afc1c';
  const url = `https://pixabay.com/api/?key=${key}&q=${termino}&per_page=${registrosPorPagina}&page=${paginaActual}`;

  try {
    const respuesta = await fetch(url);  // Llamada a la API
    const datos = await respuesta.json(); // Convertimos la respuesta a JSON

    // Calculamos cuántas páginas hay en total
    totalPaginas = calcularPaginas(datos.totalHits);

    // Mostramos las imágenes obtenidas
    mostrarImagenes(datos.hits);
  } catch (error) {
    console.error('Error al obtener imágenes', error);
  }
}

/* =====================================================
   FUNCIÓN: calcularPaginas()
   -----------------------------------------------------
   - Calcula cuántas páginas existen en base al total
     de resultados y al número de resultados por página.
===================================================== */
function calcularPaginas(total) {
  return Math.ceil(total / registrosPorPagina);
}

/* =====================================================
   FUNCIÓN: mostrarImagenes()
   -----------------------------------------------------
   - Limpia resultados anteriores.
   - Muestra las imágenes devueltas por la API con su info.
   - Crea tarjetas con datos de likes, vistas y enlace a la imagen.
   - Llama a imprimirPaginador() para generar botones de página.
===================================================== */
function mostrarImagenes(imagenes) {
  // Limpiamos el contenido previo
  limpiarHTML(resultado);
  limpiarHTML(paginacionDiv);

  // Si no hay resultados, avisamos al usuario
  if (imagenes.length === 0) {
    mostrarError('No se encontraron resultados');
    return;
  }

  // Recorremos todas las imágenes y las mostramos en pantalla
  imagenes.forEach(imagen => {
    const { previewURL, likes, views, largeImageURL } = imagen;

    // Contenedor principal de cada tarjeta
    const contenedor = document.createElement('div');
    contenedor.classList.add('w-1/2', 'md:w-1/3', 'lg:w-1/4', 'mb-4', 'p-3');

    // Tarjeta visual
    const card = document.createElement('div');
    card.classList.add('bg-white');

    // Imagen principal (vista previa)
    const img = document.createElement('img');
    img.src = previewURL;
    img.classList.add('w-full');

    // Contenedor para la información (likes, vistas, enlace)
    const info = document.createElement('div');
    info.classList.add('p-4');

    // Texto: número de likes
    const likesP = document.createElement('p');
    likesP.innerHTML = `<span class="font-bold">${likes}</span> <span class="font-light">Me gusta</span>`;

    // Texto: número de vistas
    const viewsP = document.createElement('p');
    viewsP.innerHTML = `<span class="font-bold">${views}</span> <span class="font-light">Vistas</span>`;

    // Enlace a la imagen completa
    const enlace = document.createElement('a');
    enlace.href = largeImageURL;
    enlace.target = '_blank';
    enlace.textContent = 'Ver imagen';
    enlace.classList.add(
      'block',
      'w-full',
      'bg-blue-800',
      'hover:bg-blue-500',
      'text-white',
      'uppercase',
      'font-bold',
      'text-center',
      'rounded',
      'mt-5',
      'p-1'
    );

    // Insertamos los elementos en orden
    info.appendChild(likesP);
    info.appendChild(viewsP);
    info.appendChild(enlace);

    card.appendChild(img);
    card.appendChild(info);
    contenedor.appendChild(card);

    // Agregamos la tarjeta completa al contenedor principal
    resultado.appendChild(contenedor);
  });

  // Mostramos el paginador
  imprimirPaginador();
}

/* =====================================================
   FUNCIÓN: limpiarHTML()
   -----------------------------------------------------
   - Elimina todos los elementos hijos del contenedor dado.
   - Se usa para limpiar resultados o botones previos.
===================================================== */
function limpiarHTML(elemento) {
  while (elemento.firstChild) {
    elemento.removeChild(elemento.firstChild);
  }
}

/* =====================================================
   GENERADOR: crearPaginador()
   -----------------------------------------------------
   - Es un generador (función especial con yield) que
     produce números de página de 1 al total.
   - Se usa para iterar fácilmente al crear los botones.
===================================================== */
function *crearPaginador(total) {
  for (let i = 1; i <= total; i++) {
    yield i;
  }
}

/* =====================================================
   FUNCIÓN: imprimirPaginador()
   -----------------------------------------------------
   - Usa el generador crearPaginador() para crear enlaces
     numerados que permiten cambiar de página.
   - Cada botón vuelve a ejecutar buscarImagenes() con
     la nueva página seleccionada.
===================================================== */
function imprimirPaginador() {
  // Creamos el iterador basado en el número total de páginas
  iterador = crearPaginador(totalPaginas);

  limpiarHTML(paginacionDiv);

  while (true) {
    const { value, done } = iterador.next();
    if (done) return; // Si no hay más páginas, salimos

    // Creamos un enlace (botón) para cada número de página
    const boton = document.createElement('a');
    boton.href = '#';
    boton.dataset.pagina = value;
    boton.textContent = value;
    boton.classList.add(
      'siguiente',
      'bg-yellow-400',
      'px-4',
      'py-1',
      'mr-2',
      'font-bold',
      'mb-4',
      'rounded',
      'hover:bg-yellow-500'
    );

    // Cuando el usuario hace clic, se actualiza la página actual
    boton.onclick = () => {
      paginaActual = value;
      const termino = document.querySelector('#termino').value.trim();
      buscarImagenes(termino); // Se vuelve a ejecutar la búsqueda
    };

    // Agregamos el botón al contenedor del paginador
    paginacionDiv.appendChild(boton);
  }
}

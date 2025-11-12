//código js para prueba 1ª evaluación
import { obtenerClientes, eliminarCliente } from './API.js';

const CategoriasSelect = document.querySelector('#categorias'); // Select con la moneda fiat
const formulario = document.querySelector('#formulario'); // Formulario donde se seleccionan las opciones
const resultadoDiv = document.querySelector('#resultado'); // Div donde se mostrará la información de la cotización

// Al cargar el DOM, obtenemos las criptomonedas
document.addEventListener('DOMContentLoaded', obtenerCategorias);

// Evento submit del formulario
formulario.addEventListener('submit', submitFormulario);

// Función que obtiene las criptomonedas desde la API
async function obtenerCategorias() {
  const url = 'www.themealdb.com/api/json/v1/1/categories.php';
  try {
    const respuesta = await fetch(url); // Petición a la API
    const data = await respuesta.json(); // Parseamos la respuesta JSON

    const categorias = data.Data; // Obtenemos el array de criptomonedas

    llenarSelectCriptos(categorias); // Llenamos el select con las opciones
  } catch (error) {
    mostrarError('Error al cargar las criptomonedas'); // Mostramos error si falla la petición
    console.error(error);
  }
}

// Función que llena el select de criptomonedas
function llenarSelectCategorias(categorias) {
  categorias.forEach(categoria => {
    const { FullName, Name } = categoria.CoinInfo; // Obtenemos el nombre completo y el símbolo

    const option = document.createElement('option'); // Creamos un elemento option
    option.value = Name; // Valor será el símbolo de la cripto
    option.textContent = FullName; // Texto visible será el nombre completo
    CategoriasSelect.appendChild(option); // Agregamos la opción al select
  });
}
// Función que maneja el submit del formulario
function submitFormulario(e) {
  e.preventDefault(); // Prevenimos el comportamiento por defecto (recargar la página)

  const categoria = CategoriasSelect.value; // Obtenemos la moneda seleccionada

  if (categoria === '') {
    mostrarError('Debes seleccionar ambas opciones'); // Validamos que se seleccione todo
    return;
  }

  consultarAPI(categoria); // Llamamos a la API con los valores seleccionados
}

// Función que consulta la API categorias seleccionadas
async function consultarAPI(categoria) {
  const url = `www.themealdb.com/api/json/v1/1/categories.phpfsyms=${categoria}`;

  mostrarSpinner(); // Mostramos spinner mientras llega la información

  try {
    const respuesta = await fetch(url);
    const data = await respuesta.json();

    const info = data.DISPLAY[categoria]; // Extraemos la información relevante
    mostrarRecetas(info); // Mostramos la información en el HTML
  } catch (error) {
    mostrarError('No se pudo obtener la información'); // Mostramos error si falla la petición
    console.error(error);
  }
}

// Función que muestra la cotización en el HTML
function mostrarRecetas(info) {
  limpiarHTML(); // Limpiamos resultados previos

  const { PRICE, HIGHDAY, LOWDAY, CHANGEPCT24HOUR, LASTUPDATE } = info;

  // Creamos elementos p para cada dato y los añadimos al div resultado
  const precio = document.createElement('p');
  precio.classList.add('precio');
  precio.innerHTML = `Precio actual: <span>${PRICE}</span>`;

  const maximo = document.createElement('p');
  maximo.innerHTML = `Máximo del día: <span>${HIGHDAY}</span>`;

  const minimo = document.createElement('p');
  minimo.innerHTML = `Mínimo del día: <span>${LOWDAY}</span>`;

  const variacion = document.createElement('p');
  variacion.innerHTML = `Variación 24h: <span>${CHANGEPCT24HOUR}%</span>`;

  const actualizacion = document.createElement('p');
  actualizacion.innerHTML = `Última actualización: <span>${LASTUPDATE}</span>`;

  // Agregamos todos los elementos al div resultado
  resultadoDiv.appendChild(precio);
  resultadoDiv.appendChild(maximo);
  resultadoDiv.appendChild(minimo);
  resultadoDiv.appendChild(variacion);
  resultadoDiv.appendChild(actualizacion);
}

function mostrarError(mensaje) {
  const existe = document.querySelector('.error'); // Si ya hay un error visible, lo removemos
  if (existe) existe.remove();

  const divError = document.createElement('div'); // Creamos un div para el error
  divError.classList.add('error');
  divError.textContent = mensaje;
  divError.style.backgroundColor = 'red';
  divError.style.color = 'white';
  divError.style.padding = '8px';
  divError.style.textAlign = 'center';
  divError.style.marginTop = '10px';
  divError.style.borderRadius = '5px';

  formulario.appendChild(divError); // Lo agregamos al formulario

  setTimeout(() => divError.remove(), 2000); // Lo eliminamos después de 2 segundos
}
// Función que muestra un spinner de carga mientras llega la información
function mostrarSpinner() {
  limpiarHTML(); // Limpiamos resultados previos

  const spinner = document.createElement('div');
  spinner.classList.add('spinner');
  spinner.innerHTML = `
    <div class="sk-chase">
      <div class="sk-chase-dot"></div>
      <div class="sk-chase-dot"></div>
      <div class="sk-chase-dot"></div>
      <div class="sk-chase-dot"></div>
      <div class="sk-chase-dot"></div>
      <div class="sk-chase-dot"></div>
    </div>
  `;
  resultadoDiv.appendChild(spinner); // Lo añadimos al div resultado
}
// Función que limpia el contenido del div resultado
function limpiarHTML() {
  resultadoDiv.innerHTML = '';
}

//Recetas

// Importamos las funciones necesarias desde el módulo API.js
// - obtenerClientes(): trae la lista completa de clientes desde el servidor.
import { obtenerRecetas} from './API.js';

// Cuando el documento se haya cargado completamente (HTML listo),
// se ejecuta la función mostrarClientes() para cargar los datos en pantalla.
document.addEventListener('DOMContentLoaded', mostrarRecetas);

/* =====================================================
   FUNCIÓN: mostrarClientes()
   -----------------------------------------------------
   - Obtiene todos los clientes desde la API.
   - Crea dinámicamente las filas de la tabla con sus datos.
   - Agrega enlaces para editar o eliminar cada cliente.
   - Configura el evento de eliminación.
===================================================== */
async function mostrarRecetass() {
  // Referencia al elemento <tbody> donde se mostrarán los clientes.
  const listado = document.querySelector('#listado-clientes');

  // Esperamos la respuesta de la API (promesa) y la convertimos en un array de clientes.
  const clientes = await obtenerClientes();

  // Recorremos cada cliente y construimos una fila (tr) para mostrarlo en la tabla.
  clientes.forEach(cliente => {
    // Desestructuramos las propiedades del objeto cliente.
    const { nombre, telefono, empresa, id } = cliente;

    // Creamos una nueva fila de tabla (<tr>)
    const row = document.createElement('tr');

    // Insertamos el contenido HTML de la fila con los datos del cliente.
    // También se crean dos enlaces:
    //   - “Editar”: redirige a editar-cliente.html con el ID del cliente en la URL.
    //   - “Eliminar”: ejecutará la acción de borrado al hacer clic.
    row.innerHTML = `
      <td class="px-6 py-4 border-b border-gray-200">${nombre}</td>
      <td class="px-6 py-4 border-b border-gray-200">${telefono}</td>
      <td class="px-6 py-4 border-b border-gray-200">${empresa}</td>
      <td class="px-6 py-4 border-b border-gray-200">
        <a href="editar-cliente.html?id=${id}" class="text-teal-600 hover:text-teal-900 mr-5">Editar</a>
        <a href="#" data-cliente="${id}" class="text-red-600 hover:text-red-900 eliminar">Eliminar</a>
      </td>
    `;
  });

}


// Importamos las funciones necesarias desde el módulo API.js
// - obtenerClientes(): trae la lista completa de clientes desde el servidor.
// - eliminarCliente(): elimina un cliente por su ID.
import { obtenerClientes, eliminarCliente } from './API.js';

// Cuando el documento se haya cargado completamente (HTML listo),
// se ejecuta la función mostrarClientes() para cargar los datos en pantalla.
document.addEventListener('DOMContentLoaded', mostrarClientes);

/* =====================================================
   FUNCIÓN: mostrarClientes()
   -----------------------------------------------------
   - Obtiene todos los clientes desde la API.
   - Crea dinámicamente las filas de la tabla con sus datos.
   - Agrega enlaces para editar o eliminar cada cliente.
   - Configura el evento de eliminación.
===================================================== */
async function mostrarClientes() {
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

    // Agregamos la fila al listado (al cuerpo de la tabla).
    listado.appendChild(row);
  });

  // Delegación de eventos:
  // Escuchamos los clics en todo el listado, pero solo actuamos si el clic fue en un botón "Eliminar".
  listado.addEventListener('click', confirmarEliminar);
}

/* =====================================================
   FUNCIÓN: confirmarEliminar(e)
   -----------------------------------------------------
   - Se ejecuta cuando el usuario hace clic en un enlace "Eliminar".
   - Pide confirmación antes de borrar el registro.
   - Si se confirma, llama a la API para eliminar el cliente.
   - Finalmente, elimina la fila del DOM sin recargar la página.
===================================================== */
async function confirmarEliminar(e) {
  // Verifica si el elemento clicado tiene la clase "eliminar"
  // (es decir, si el usuario hizo clic en el botón de eliminar).
  if (e.target.classList.contains('eliminar')) {
    // Obtiene el ID del cliente desde el atributo data-cliente del enlace.
    const id = e.target.dataset.cliente;

    // Muestra una ventana de confirmación antes de eliminar.
    const confirmarBorrado = confirm('¿Deseas eliminar este cliente?');

    // Si el usuario confirma la eliminación:
    if (confirmarBorrado) {
      // Llamamos a la función que elimina el cliente de la base de datos (API).
      await eliminarCliente(id);

      // Mostramos un mensaje de éxito.
      alert('Cliente eliminado correctamente');

      // Eliminamos la fila del cliente directamente del DOM,
      // usando el método closest() para encontrar el <tr> más cercano.
      e.target.closest('tr').remove();
    }
  }
}

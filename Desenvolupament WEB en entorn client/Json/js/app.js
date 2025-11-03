import { obtenerClientes, eliminarCliente } from './API.js';

document.addEventListener('DOMContentLoaded', mostrarClientes);

async function mostrarClientes() {
  const listado = document.querySelector('#listado-clientes');
  const clientes = await obtenerClientes();

  clientes.forEach(cliente => {
    const { nombre, telefono, empresa, id } = cliente;

    const row = document.createElement('tr');
    row.innerHTML = `
      <td class="px-6 py-4 border-b border-gray-200">${nombre}</td>
      <td class="px-6 py-4 border-b border-gray-200">${telefono}</td>
      <td class="px-6 py-4 border-b border-gray-200">${empresa}</td>
      <td class="px-6 py-4 border-b border-gray-200">
        <a href="editar-cliente.html?id=${id}" class="text-teal-600 hover:text-teal-900 mr-5">Editar</a>
        <a href="#" data-cliente="${id}" class="text-red-600 hover:text-red-900 eliminar">Eliminar</a>
      </td>
    `;
    listado.appendChild(row);
  });

  listado.addEventListener('click', confirmarEliminar);
}

async function confirmarEliminar(e) {
  // solo si el clic fue en un botón con la clase "eliminar"
  if (e.target.classList.contains('eliminar')) {
    const id = e.target.dataset.cliente; // 👈 no usamos parseInt

    const confirmarBorrado = confirm('¿Deseas eliminar este cliente?'); // 👈 declaramos correctamente

    if (confirmarBorrado) {
      await eliminarCliente(id);
      alert('Cliente eliminado correctamente');

      // Eliminar la fila directamente sin recargar
      e.target.closest('tr').remove();
    }
  }
}


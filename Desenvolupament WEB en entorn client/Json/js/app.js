//inicia la aplicación. Puede contener alguna función complementaria

import { obtenerClientes } from './api.js';

document.addEventListener('DOMContentLoaded', async () => {
  const contenedor = document.querySelector('#clientes');
  const clientes = await obtenerClientes();

  clientes.forEach(cliente => {
    const div = document.createElement('div');
    div.className = 'bg-white p-3 rounded shadow';
    div.textContent = `${cliente.nombre} - ${cliente.email}`;
    contenedor.appendChild(div);
  });
});

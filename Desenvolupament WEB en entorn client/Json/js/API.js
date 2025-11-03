// js/api.js
const URL = 'http://localhost:4000/clientes';

// OBTENER todos los clientes
export async function obtenerClientes() {
  const respuesta = await fetch(URL);
  return await respuesta.json();
}

// OBTENER un cliente por ID
export async function obtenerCliente(id) {
  const respuesta = await fetch(`${URL}/${id}`);
  return await respuesta.json();
}

// CREAR nuevo cliente
export async function nuevoCliente(cliente) {
  await fetch(URL, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(cliente),
  });
}

// ACTUALIZAR cliente existente
export async function editarCliente(id, cliente) {
  await fetch(`${URL}/${id}`, {
    method: 'PUT',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(cliente),
  });
}

// ELIMINAR cliente
export async function eliminarCliente(id) {
  await fetch(`${URL}/${id}`, {
    method: 'DELETE',
  });
}

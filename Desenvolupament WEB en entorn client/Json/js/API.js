// js/api.js
const URL = 'http://localhost:4000/clientes';

// ✅ Obtener todos los clientes
export async function obtenerClientes() {
  const respuesta = await fetch(URL);
  const resultado = await respuesta.json();
  return resultado;
}

// ✅ Eliminar un cliente
export async function eliminarCliente(id) {
  await fetch(`${URL}/${id}`, { method: 'DELETE' });
}

// ✅ Crear un cliente
export async function nuevoCliente(cliente) {
  await fetch(URL, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(cliente),
  });
}

// ✅ Editar un cliente
export async function editarCliente(id, datos) {
  await fetch(`${URL}/${id}`, {
    method: 'PUT',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(datos),
  });
}

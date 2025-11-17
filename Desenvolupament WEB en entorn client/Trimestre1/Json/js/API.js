// js/api.js

// URL base del servidor o API donde están almacenados los datos de los clientes.
// En este caso, se asume que se está utilizando JSON Server corriendo en el puerto 4000.
const URL = 'http://localhost:4000/clientes';

/* =====================================================
   FUNCIÓN: obtenerClientes()
   -----------------------------------------------------
   - Hace una solicitud GET al servidor para traer
     todos los registros de clientes.
   - Devuelve la respuesta convertida en JSON.
===================================================== */
export async function obtenerClientes() {
  // Se hace la petición HTTP al endpoint /clientes
  const respuesta = await fetch(URL);
  // Se convierte la respuesta (que viene como JSON) a objeto JavaScript
  return await respuesta.json();
}

/* =====================================================
   FUNCIÓN: obtenerCliente(id)
   -----------------------------------------------------
   - Obtiene un único cliente según su ID.
   - Ideal para cuando se necesita editar o ver detalles.
===================================================== */
export async function obtenerCliente(id) {
  // Se hace la petición GET al endpoint específico (clientes/ID)
  const respuesta = await fetch(`${URL}/${id}`);
  // Se devuelve el cliente encontrado en formato JSON
  return await respuesta.json();
}

/* =====================================================
   FUNCIÓN: nuevoCliente(cliente)
   -----------------------------------------------------
   - Envía los datos de un nuevo cliente al servidor.
   - Usa el método HTTP POST.
   - Convierte el objeto cliente a JSON antes de enviarlo.
===================================================== */
export async function nuevoCliente(cliente) {
  await fetch(URL, {
    method: 'POST', // Se usa POST para crear un nuevo registro
    headers: { 'Content-Type': 'application/json' }, // Indica que se envía JSON
    body: JSON.stringify(cliente), // Convierte el objeto a formato JSON
  });
}

/* =====================================================
   FUNCIÓN: editarCliente(id, cliente)
   -----------------------------------------------------
   - Actualiza los datos de un cliente existente.
   - Usa el método HTTP PUT (reemplaza el registro completo).
   - Se envía el objeto actualizado al servidor.
===================================================== */
export async function editarCliente(id, cliente) {
  await fetch(`${URL}/${id}`, {
    method: 'PUT', // PUT reemplaza el registro completo
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(cliente), // Se convierte el cliente actualizado en JSON
  });
}

/* =====================================================
   FUNCIÓN: eliminarCliente(id)
   -----------------------------------------------------
   - Elimina un cliente según su ID.
   - Usa el método HTTP DELETE.
   - No devuelve nada, pero borra el registro en el servidor.
===================================================== */
export async function eliminarCliente(id) {
  await fetch(`${URL}/${id}`, {
    method: 'DELETE', // Se usa DELETE para eliminar el cliente del servidor
  });
}

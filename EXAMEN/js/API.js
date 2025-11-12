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
export async function obtenerRecetas() {
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
export async function obtenera(id) {
  // Se hace la petición GET al endpoint específico (clientes/ID)
  const respuesta = await fetch(`${URL}/${id}`);
  // Se devuelve el cliente encontrado en formato JSON
  return await respuesta.json();
}


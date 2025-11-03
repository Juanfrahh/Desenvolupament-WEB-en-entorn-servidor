//Acciones con la API de Json Server
const URL = 'http://localhost:4000/clientes';

export async function obtenerClientes() {
  const respuesta = await fetch(URL);
  return await respuesta.json();
}

// js/api.js
const URL = 'http://localhost:4000/clientes';

export async function nuevoCliente(cliente) {
  await fetch(URL, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(cliente)
  });
}

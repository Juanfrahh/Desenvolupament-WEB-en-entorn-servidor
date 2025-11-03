import { mostrarAlerta, validar } from './funciones.js';

import { nuevoCliente } from './api.js';

document.addEventListener('DOMContentLoaded', () => {
  const formulario = document.querySelector('#formulario');
  formulario.addEventListener('submit', validarCliente);
});

async function validarCliente(e) {
  e.preventDefault();

  const nombre = document.querySelector('#nombre').value.trim();
  const email = document.querySelector('#email').value.trim();
  const telefono = document.querySelector('#telefono').value.trim();
  const empresa = document.querySelector('#empresa').value.trim();

  const cliente = { nombre, email, telefono, empresa };

  if (validar(cliente)) {
    mostrarAlerta('Todos los campos son obligatorios');
    return;
  }

  await nuevoCliente(cliente);
  alert('Cliente agregado correctamente');
  window.location.href = 'index.html';
}

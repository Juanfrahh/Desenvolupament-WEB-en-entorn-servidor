// js/nuevocliente.js
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

  if (nombre === '' || email === '' || telefono === '' || empresa === '') {
    mostrarAlerta('Todos los campos son obligatorios');
    return;
  }

  const cliente = { nombre, email, telefono, empresa };

  await nuevoCliente(cliente);

  alert('Cliente agregado correctamente');
  window.location.href = 'index.html';
}

function mostrarAlerta(mensaje) {
  const existe = document.querySelector('.bg-red-100');
  if (existe) return;

  const alerta = document.createElement('p');
  alerta.classList.add(
    'bg-red-100',
    'border-red-400',
    'text-red-700',
    'px-4',
    'py-3',
    'rounded',
    'max-w-lg',
    'mx-auto',
    'mt-6',
    'text-center'
  );
  alerta.textContent = mensaje;
  document.querySelector('#formulario').appendChild(alerta);

  setTimeout(() => alerta.remove(), 3000);
}

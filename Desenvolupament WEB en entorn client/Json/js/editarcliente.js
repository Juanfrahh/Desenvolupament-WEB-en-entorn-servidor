// js/editarcliente.js
import { obtenerCliente, editarCliente } from './api.js';

document.addEventListener('DOMContentLoaded', async () => {
  const parametrosURL = new URLSearchParams(window.location.search);
  const idCliente = parametrosURL.get('id');

  if (idCliente) {
    const cliente = await obtenerCliente(idCliente);
    mostrarCliente(cliente);
  }

  const formulario = document.querySelector('#formulario');
  formulario.addEventListener('submit', validarCliente);
});

function mostrarCliente(cliente) {
  const { nombre, email, telefono, empresa, id } = cliente;

  document.querySelector('#nombre').value = nombre;
  document.querySelector('#email').value = email;
  document.querySelector('#telefono').value = telefono;
  document.querySelector('#empresa').value = empresa;
  document.querySelector('#id').value = id;
}

async function validarCliente(e) {
  e.preventDefault();

  const nombre = document.querySelector('#nombre').value.trim();
  const email = document.querySelector('#email').value.trim();
  const telefono = document.querySelector('#telefono').value.trim();
  const empresa = document.querySelector('#empresa').value.trim();
  const id = document.querySelector('#id').value;

  if (nombre === '' || email === '' || telefono === '' || empresa === '') {
    mostrarAlerta('Todos los campos son obligatorios');
    return;
  }

  const clienteActualizado = { nombre, email, telefono, empresa };

  await editarCliente(id, clienteActualizado);

  alert('Cliente actualizado correctamente');
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

// appClases.js
import { Poliza, llenarSelectAnios } from './app.js';

// Referencias al DOM
const formulario = document.getElementById('cotizar-seguro');
const modalElement = document.getElementById('modal');
const modal = new bootstrap.Modal(modalElement);
const modalTitle = modalElement.querySelector('.modal-title');
const modalBody = modalElement.querySelector('.modal-body');
const modalFooter = modalElement.querySelector('.modal-footer');

// Cargar años al iniciar
document.addEventListener('DOMContentLoaded', () => {
  llenarSelectAnios();
});

// Evento submit del formulario
formulario.addEventListener('submit', (e) => {
  e.preventDefault();

  const gama = document.querySelector('#gama').value;
  const year = document.querySelector('#year').value;
  const tipo = document.querySelector('input[name="tipo"]:checked')?.value;

  if (gama === '' || year === '' || tipo === '') {
    mostrarMensaje('Todos los campos son obligatorios', 'error');
    return;
  }

  const poliza = new Poliza(gama, year, tipo);
  poliza.calcularSeguro();
  poliza.mostrarInfoHTML();
});

// Mostrar mensaje temporal en el formulario
function mostrarMensaje(texto, tipo) {
  const div = document.createElement('div');
  div.textContent = texto;
  div.classList.add('text-center', 'p-2', 'rounded-lg', 'mt-3', 'text-white');
  div.classList.add(tipo === 'error' ? 'bg-red-600' : 'bg-green-500');

  formulario.insertBefore(div, document.querySelector('#resultado'));

  setTimeout(() => div.remove(), 3000);
}

// Variables necesarias para que Poliza funcione
export { modal, modalTitle, modalBody, modalFooter };

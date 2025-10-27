// appClases.js
import { Poliza, llenarSelectAnios } from './app.js';

// Referencias al DOM y modal (bootstrap)
const formulario = document.getElementById('cotizar-seguro');
const modalElement = document.getElementById('modal');
const modal = new bootstrap.Modal(modalElement);
const modalTitle = modalElement.querySelector('.modal-title');
const modalBody = modalElement.querySelector('.modal-body');
const modalFooter = modalElement.querySelector('.modal-footer');

document.addEventListener('DOMContentLoaded', () => {
  llenarSelectAnios();
});

/* Mostrar mensaje temporal (controla que no se acumulen) */
function mostrarMensaje(texto, tipo) {
  const formularioEl = document.getElementById('cotizar-seguro');
  if (!formularioEl) return;

  // Si ya existe un mensaje temporal lo borramos antes
  const existente = formularioEl.querySelector('.mensaje-temporal');
  if (existente) {
    existente.remove();
  }

  const div = document.createElement('div');
  div.textContent = texto;
  div.classList.add('mensaje-temporal', 'text-center', 'p-2', 'rounded-lg', 'mt-3', 'text-white');
  div.classList.add(tipo === 'error' ? 'bg-red-600' : 'bg-green-500');

  // Insertar antes del contenedor de resultado
  const lugar = document.querySelector('#resultado') || null;
  formularioEl.insertBefore(div, lugar);

  // Desaparece tras 3 segundos (3000 ms)
  setTimeout(() => {
    // antes de eliminar, comprobamos si sigue en el DOM
    if (div.parentNode) div.remove();
  }, 3000);
}

/* Manejo del submit */
if (formulario) {
  formulario.addEventListener('submit', (e) => {
    e.preventDefault();

    const gama = document.querySelector('#gama')?.value || '';
    const year = document.querySelector('#year')?.value || '';
    const tipo = document.querySelector('input[name="tipo"]:checked')?.value || '';

    if (gama === '' || year === '' || tipo === '') {
      mostrarMensaje('Todos los campos son obligatorios', 'error');
      return;
    }

    const poliza = new Poliza(gama, year, tipo);
    poliza.calcularSeguro();

    modalTitle.textContent = 'RESUMEN DE PÓLIZA';
    modalBody.innerHTML = poliza.toResumenHTML();

    modalFooter.innerHTML = '';
    const btnCerrar = document.createElement('button');
    btnCerrar.textContent = 'Cerrar';
    btnCerrar.classList.add('btn', 'btn-primary');
    btnCerrar.onclick = () => modal.hide();
    modalFooter.appendChild(btnCerrar);

    modal.show();
  });
}

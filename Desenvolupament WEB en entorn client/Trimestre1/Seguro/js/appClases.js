// appClases.js
// Este módulo importa Poliza y llenarSelectAnios desde app.js
// Relación con HTML:
// - <form id="cotizar-seguro">  => formulario variable 'formulario'
// - <div id="resultado">        => lugar para insertar mensajes temporales (se usa como referencia)
// - .modal (id="modal")         => modal bootstrap donde mostramos el resumen

import { Poliza, llenarSelectAnios } from './app.js';

// Referencias a elementos del HTML
const formulario = document.getElementById('cotizar-seguro'); // <form id="cotizar-seguro">
const modalElement = document.getElementById('modal');       // <div id="modal" class="modal ...">
const modal = modalElement ? new bootstrap.Modal(modalElement) : null;

// Elementos dentro de la modal (se corresponden con la estructura HTML de la modal)
const modalTitle = modalElement ? modalElement.querySelector('.modal-title') : null;
const modalBody = modalElement ? modalElement.querySelector('.modal-body') : null;
const modalFooter = modalElement ? modalElement.querySelector('.modal-footer') : null;

// Variable para controlar el timeout del mensaje (evita acumulación)
let mensajeTimeout = null;

document.addEventListener('DOMContentLoaded', () => {
  // Rellena el select #year en el HTML al cargar la página
  llenarSelectAnios();
});

// Mostrar mensaje temporal (error o success) en el formulario.
// Relación con HTML: inserta antes de #resultado dentro del formulario (#cotizar-seguro)
function mostrarMensaje(texto, tipo = 'error', duracion = 3000) {
  const formularioEl = document.getElementById('cotizar-seguro');
  if (!formularioEl) return;

  // Si ya existe un mensaje temporal, lo eliminamos y limpiamos su timeout
  const existente = formularioEl.querySelector('.mensaje-temporal');
  if (existente) {
    existente.remove();
    if (mensajeTimeout) {
      clearTimeout(mensajeTimeout);
      mensajeTimeout = null;
    }
  }

  // Creamos el div de mensaje (se verá en el HTML)
  const div = document.createElement('div');
  div.textContent = texto;
  div.classList.add('mensaje-temporal', 'text-center', 'p-2', 'rounded-lg', 'mt-3', 'text-white');

  // Estilos condicionados por el tipo (error => rojo, success => verde)
  div.classList.add(tipo === 'error' ? 'bg-red-600' : 'bg-green-500');

  // Insertamos el mensaje antes del contenedor de resultado en el HTML
  const lugar = document.querySelector('#resultado') || null;
  formularioEl.insertBefore(div, lugar);

  // Programamos la eliminación del mensaje tras 'duracion' ms
  mensajeTimeout = setTimeout(() => {
    if (div.parentNode) div.remove();
    mensajeTimeout = null;
  }, duracion);
}

// Lógica del formulario: al enviar calculamos la póliza y mostramos la modal
if (formulario) {
  formulario.addEventListener('submit', (e) => {
    e.preventDefault();

    // Leemos valores del HTML: select#gama, select#year, radio[name="tipo"]
    const gama = document.querySelector('#gama')?.value || '';
    const year = document.querySelector('#year')?.value || '';
    const tipo = document.querySelector('input[name="tipo"]:checked')?.value || '';

    // Validación: si falta algún campo, mostramos mensaje de error (se evita acumulación)
    if (gama === '' || year === '' || tipo === '') {
      mostrarMensaje('Todos los campos son obligatorios', 'error', 3000);
      return;
    }

    // Creamos el objeto Poliza (clase definida en app.js)
    const poliza = new Poliza(gama, year, tipo);
    poliza.calcularSeguro(); // calcula y actualiza poliza.importe

    // ---- Inyectamos contenido en la modal (título y cuerpo) ----
    if (modalTitle) modalTitle.textContent = 'RESUMEN DE PÓLIZA';
    if (modalBody) modalBody.innerHTML = poliza.toResumenHTML();

    // ---- Construcción dinámica del footer de la modal ----
    if (modalFooter) {
      // Limpiamos footer previo
      modalFooter.innerHTML = '';

      // Botón cerrar (inserta en el HTML de la modal)
      const btnCerrar = document.createElement('button');
      btnCerrar.textContent = 'Cerrar';
      btnCerrar.classList.add('btn', 'btn-primary');
      btnCerrar.type = 'button';
      btnCerrar.onclick = () => { if (modal) modal.hide(); };

      modalFooter.appendChild(btnCerrar);
    }

    // Mostramos la modal (si bootstrap está disponible y el modal se inicializó)
    if (modal) modal.show();
  });
}

// js/nuevocliente.js

// Importamos funciones de otros módulos:
// - mostrarAlerta(): muestra un mensaje de error o advertencia en pantalla.
// - validar(): comprueba si los campos del formulario están vacíos.
// - nuevoCliente(): envía los datos del nuevo cliente al servidor (API).
import { mostrarAlerta, validar } from './funciones.js';
import { nuevoCliente } from './API.js';

/* =====================================================
   EVENTO PRINCIPAL: DOMContentLoaded
   -----------------------------------------------------
   - Espera a que el documento HTML esté completamente cargado.
   - Selecciona el formulario y agrega el evento 'submit'.
   - Cuando el usuario envía el formulario, se ejecuta validarCliente().
===================================================== */
document.addEventListener('DOMContentLoaded', () => {
  // Seleccionamos el formulario en el DOM
  const formulario = document.querySelector('#formulario');

  // Escuchamos el evento 'submit' (envío del formulario)
  formulario.addEventListener('submit', validarCliente);
});

/* =====================================================
   FUNCIÓN: validarCliente(e)
   -----------------------------------------------------
   - Se ejecuta al enviar el formulario.
   - Obtiene los valores de los campos y los valida.
   - Si son válidos, envía el cliente a la API y redirige al listado principal.
===================================================== */
async function validarCliente(e) {
  // Evitamos que el formulario recargue la página automáticamente
  e.preventDefault();

  // Obtenemos los valores ingresados en los campos del formulario,
  // y los limpiamos con .trim() para eliminar espacios en blanco innecesarios.
  const nombre = document.querySelector('#nombre').value.trim();
  const email = document.querySelector('#email').value.trim();
  const telefono = document.querySelector('#telefono').value.trim();
  const empresa = document.querySelector('#empresa').value.trim();

  // Creamos un objeto con la información del cliente nuevo
  const cliente = { nombre, email, telefono, empresa };

  // ----------------------------------------------------
  // VALIDACIÓN DE CAMPOS
  // ----------------------------------------------------
  // Usamos la función validar() importada desde funciones.js
  // Si devuelve true → significa que hay campos vacíos.
  if (validar(cliente)) {
    // Mostramos una alerta visual para avisar al usuario.
    mostrarAlerta('Todos los campos son obligatorios');
    return; // Detenemos la ejecución si hay error.
  }

  // ----------------------------------------------------
  // ENVÍO DE DATOS A LA API
  // ----------------------------------------------------
  // Si todo está correcto, usamos nuevoCliente() para guardar
  // el nuevo registro en la base de datos a través del servidor.
  await nuevoCliente(cliente);

  // Mostramos una alerta de éxito al usuario
  alert('Cliente agregado correctamente');

  // Redirigimos automáticamente al usuario al listado de clientes
  window.location.href = 'index.html';
}

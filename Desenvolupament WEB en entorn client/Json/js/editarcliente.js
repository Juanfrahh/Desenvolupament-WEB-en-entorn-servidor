// js/editarcliente.js

// Importamos las funciones necesarias desde API.js
// - obtenerCliente(): obtiene los datos de un cliente específico desde la API.
// - editarCliente(): actualiza los datos de un cliente existente en la base de datos.
import { obtenerCliente, editarCliente } from './API.js';

/* =====================================================
   EVENTO PRINCIPAL: DOMContentLoaded
   -----------------------------------------------------
   - Espera a que el documento HTML esté completamente cargado.
   - Obtiene el ID del cliente desde la URL.
   - Si el ID existe, obtiene los datos del cliente y los muestra en el formulario.
   - También agrega el listener para manejar el envío del formulario.
===================================================== */
document.addEventListener('DOMContentLoaded', async () => {
  // Obtenemos los parámetros de la URL (ej: ?id=3)
  const parametrosURL = new URLSearchParams(window.location.search);

  // Extraemos el valor del parámetro 'id'
  const idCliente = parametrosURL.get('id');

  // Si existe un ID en la URL, obtenemos la información del cliente correspondiente
  if (idCliente) {
    const cliente = await obtenerCliente(idCliente);
    // Mostramos los datos del cliente en los campos del formulario
    mostrarCliente(cliente);
  }

  // Referencia al formulario de edición
  const formulario = document.querySelector('#formulario');

  // Escuchamos el evento 'submit' (cuando el usuario presiona el botón de guardar)
  formulario.addEventListener('submit', validarCliente);
});

/* =====================================================
   FUNCIÓN: mostrarCliente(cliente)
   -----------------------------------------------------
   - Rellena los campos del formulario con los datos
     del cliente que se va a editar.
===================================================== */
function mostrarCliente(cliente) {
  // Desestructuramos las propiedades del objeto cliente recibido
  const { nombre, email, telefono, empresa, id } = cliente;

  // Insertamos los valores en los inputs del formulario
  document.querySelector('#nombre').value = nombre;
  document.querySelector('#email').value = email;
  document.querySelector('#telefono').value = telefono;
  document.querySelector('#empresa').value = empresa;
  document.querySelector('#id').value = id; // Campo oculto para conservar el ID
}

/* =====================================================
   FUNCIÓN: validarCliente(e)
   -----------------------------------------------------
   - Valida los campos del formulario antes de enviar.
   - Si todos son válidos, actualiza el cliente en la API.
   - Luego redirige al usuario al listado principal.
===================================================== */
async function validarCliente(e) {
  // Prevenimos el comportamiento por defecto del formulario (recargar la página)
  e.preventDefault();

  // Obtenemos los valores ingresados por el usuario
  const nombre = document.querySelector('#nombre').value.trim();
  const email = document.querySelector('#email').value.trim();
  const telefono = document.querySelector('#telefono').value.trim();
  const empresa = document.querySelector('#empresa').value.trim();
  const id = document.querySelector('#id').value;

  // Validamos que ningún campo esté vacío
  if (nombre === '' || email === '' || telefono === '' || empresa === '') {
    mostrarAlerta('Todos los campos son obligatorios');
    return; // Se detiene la ejecución si falta algún campo
  }

  // Creamos un objeto con los datos actualizados
  const clienteActualizado = { nombre, email, telefono, empresa };

  // Llamamos a la función que envía los datos a la API para actualizar el cliente
  await editarCliente(id, clienteActualizado);

  // Mostramos una alerta de éxito al usuario
  alert('Cliente actualizado correctamente');

  // Redirigimos al usuario a la página principal (listado de clientes)
  window.location.href = 'index.html';
}

/* =====================================================
   FUNCIÓN: mostrarAlerta(mensaje)
   -----------------------------------------------------
   - Muestra una alerta visual en el formulario cuando
     ocurre un error (por ejemplo, campos vacíos).
   - Se elimina automáticamente después de 3 segundos.
===================================================== */
function mostrarAlerta(mensaje) {
  // Si ya hay una alerta visible, no crear otra
  const existe = document.querySelector('.bg-red-100');
  if (existe) return;

  // Creamos el elemento <p> que contendrá el mensaje de error
  const alerta = document.createElement('p');

  // Añadimos clases de Tailwind CSS para el estilo visual
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

  // Insertamos el texto del mensaje
  alerta.textContent = mensaje;

  // Lo agregamos dentro del formulario
  document.querySelector('#formulario').appendChild(alerta);

  // Eliminamos la alerta automáticamente después de 3 segundos
  setTimeout(() => alerta.remove(), 3000);
}

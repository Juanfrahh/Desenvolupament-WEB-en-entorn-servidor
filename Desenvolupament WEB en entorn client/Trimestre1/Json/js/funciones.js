// js/funciones.js

/* =====================================================
   FUNCIÓN: mostrarAlerta(mensaje)
   -----------------------------------------------------
   - Muestra un mensaje de error o advertencia visual
     dentro del formulario.
   - Evita que se muestren varias alertas simultáneamente.
   - Se elimina automáticamente después de 3 segundos.
===================================================== */
export function mostrarAlerta(mensaje) {
  // Buscamos si ya existe una alerta visible para evitar duplicados.
  const alerta = document.querySelector('.bg-red-100');
  if (alerta) return; // Si hay una, salimos y no creamos otra.

  // Creamos un nuevo elemento <p> que contendrá el mensaje de la alerta.
  const alertaNueva = document.createElement('p');

  // Añadimos clases de Tailwind CSS para darle estilo visual (rojo, centrado, etc.)
  alertaNueva.classList.add(
    'bg-red-100',      // Fondo rojo claro
    'border-red-400',  // Borde rojo medio
    'text-red-700',    // Texto rojo oscuro
    'px-4',            // Padding horizontal
    'py-3',            // Padding vertical
    'rounded',         // Bordes redondeados
    'max-w-lg',        // Ancho máximo (centrado visualmente)
    'mx-auto',         // Centrado horizontal
    'mt-6',            // Margen superior
    'text-center'      // Texto centrado
  );

  // Insertamos el texto que mostrará la alerta
  alertaNueva.textContent = mensaje;

  // Agregamos la alerta dentro del formulario principal
  document.querySelector('#formulario').appendChild(alertaNueva);

  // Eliminamos la alerta automáticamente después de 3 segundos
  setTimeout(() => alertaNueva.remove(), 3000);
}

/* =====================================================
   FUNCIÓN: validar(objeto)
   -----------------------------------------------------
   - Revisa si un objeto tiene algún campo vacío.
   - Devuelve TRUE si hay al menos un valor vacío.
   - Devuelve FALSE si todos los valores tienen contenido.
   - Muy útil para validar formularios antes de enviar.
===================================================== */
export function validar(objeto) {
  // Object.values(objeto) obtiene todos los valores del objeto en un array.
  // every() verifica que todos los valores sean diferentes de '' (no vacíos).
  // El "!" al inicio invierte el resultado:
  //   → devuelve true si hay algún campo vacío.
  //   → devuelve false si todos los campos están completos.
  return !Object.values(objeto).every(valor => valor !== '');
}

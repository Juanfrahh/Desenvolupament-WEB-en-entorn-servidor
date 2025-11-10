// ===============================
// 1️⃣ SELECCIÓN DE ELEMENTOS DEL HTML
// ===============================

// Seleccionamos el formulario completo con id="formulario"
const formulario = document.querySelector('#formulario');

// Cada input individual (por su id en el HTML)
const inputEmail = document.querySelector('#email');      // <input id="email" ...>
const inputAsunto = document.querySelector('#asunto');    // <input id="asunto" ...>
const inputMensaje = document.querySelector('#mensaje');  // <textarea id="mensaje" ...>

// Botones dentro del formulario
// (uno es el botón de enviar con type="submit", otro el de reset)
const btnSubmit = formulario.querySelector('button[type="submit"]');
const btnReset = formulario.querySelector('button[type="reset"]');

// Div donde se mostrará el spinner animado (HTML: <div id="spinner" class="hidden ...">)
const spinnerDiv = document.querySelector('#spinner');

// ===============================
// 2️⃣ OBJETO PARA GUARDAR LOS DATOS DEL FORMULARIO
// ===============================
// Guardará lo que el usuario escriba en cada campo.
// Se usa para saber cuándo todos los campos están completos y válidos.
const emailObj = {
  email: '',
  asunto: '',
  mensaje: ''
};

// ===============================
// 3️⃣ INICIALIZACIÓN DE LOS EVENTOS
// ===============================
// Esta función "enciende" todos los escuchadores de eventos
// y se ejecuta al cargar el archivo JS.
eventListeners();

function eventListeners() {
  // Cada campo del formulario escucha el evento "input" (cuando el usuario escribe)
  inputEmail.addEventListener('input', validar);
  inputAsunto.addEventListener('input', validar);
  inputMensaje.addEventListener('input', validar);

  // Cuando se hace submit (clic en el botón "Enviar")
  formulario.addEventListener('submit', enviarEmail);

  // Cuando se hace clic en el botón "Reset"
  btnReset.addEventListener('click', resetFormulario);
}

// ===============================
// 4️⃣ FUNCIÓN DE VALIDACIÓN DE CAMPOS
// ===============================
// Se ejecuta cada vez que el usuario escribe en un campo del formulario.
function validar(e) {
  const valor = e.target.value.trim(); // Texto que escribió el usuario
  const campo = e.target.id;            // Nombre del campo (email, asunto o mensaje)

  // Si el campo está vacío, mostramos error visual bajo el campo correspondiente
  if (valor === '') {
    mostrarError(`El campo ${campo.toUpperCase()} es obligatorio`, e.target);
    emailObj[campo] = '';  // Vacía ese valor en el objeto
    comprobarCampos();     // Verifica si el botón Enviar debe seguir desactivado
    return;
  }

  // Si el campo es email, validamos el formato con una expresión regular
  if (campo === 'email' && !validarEmail(valor)) {
    mostrarError('El EMAIL no es válido', e.target);
    emailObj[campo] = '';
    comprobarCampos();
    return;
  }

  // Si todo está correcto, limpiamos errores visuales y guardamos el valor
  limpiarError(e.target);
  emailObj[campo] = valor;
  comprobarCampos();
}

// ===============================
// 5️⃣ MOSTRAR Y LIMPIAR ERRORES EN EL HTML
// ===============================

// Muestra un mensaje de error debajo del campo (crea un <p> dinámico)
function mostrarError(mensaje, referencia) {
  limpiarError(referencia); // Primero eliminamos errores anteriores del mismo campo
  const error = document.createElement('p'); // Creamos un nuevo párrafo
  error.textContent = mensaje;               // Texto del error
  // Clases de Tailwind para estilos (rojo, centrado, pequeño, etc.)
  error.classList.add('bg-red-600', 'text-white', 'p-2', 'text-center', 'rounded', 'text-sm');
  referencia.parentElement.appendChild(error); // Lo insertamos justo debajo del input en el HTML
}

// Borra el mensaje de error si ya existía
function limpiarError(referencia) {
  const alerta = referencia.parentElement.querySelector('.bg-red-600');
  if (alerta) alerta.remove();
}

// ===============================
// 6️⃣ HABILITAR O DESHABILITAR EL BOTÓN ENVIAR
// ===============================
// Esta función se ejecuta cada vez que se valida un campo.
function comprobarCampos() {
  // Si algún campo sigue vacío, desactivamos el botón Enviar
  if (Object.values(emailObj).includes('')) {
    btnSubmit.disabled = true;
    btnSubmit.classList.add('opacity-50'); // Clase Tailwind para opacidad (botón grisáceo)
  } else {
    // Si todos están llenos y válidos, activamos el botón
    btnSubmit.disabled = false;
    btnSubmit.classList.remove('opacity-50');
  }
}

// ===============================
// 7️⃣ VALIDACIÓN DE FORMATO DE EMAIL
// ===============================
function validarEmail(email) {
  // Expresión regular para formato de email válido
  const regex = /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;
  return regex.test(email);
}

// ===============================
// 8️⃣ ENVÍO DE FORMULARIO (SIMULADO)
// ===============================
// Esta función se ejecuta al hacer "submit" en el formulario.
function enviarEmail(e) {
  e.preventDefault(); // Evita que se recargue la página

  // === Mostrar el spinner (animación de carga) ===
  // Quitamos la clase "hidden" (Tailwind → display: none)
  spinnerDiv.classList.remove('hidden');

  // Insertamos dentro del div el HTML del spinner animado
  spinnerDiv.innerHTML = `
    <div class="sk-chase">
        <div class="sk-chase-dot"></div>
        <div class="sk-chase-dot"></div>
        <div class="sk-chase-dot"></div>
        <div class="sk-chase-dot"></div>
        <div class="sk-chase-dot"></div>
        <div class="sk-chase-dot"></div>
    </div>
  `;

  // Simulamos el envío del correo (espera 2.5 segundos)
  setTimeout(() => {
    // === Ocultar el spinner una vez "enviado" ===
    spinnerDiv.classList.add('hidden');
    spinnerDiv.innerHTML = ''; // Limpiamos el contenido del div

    // === Mostrar mensaje de éxito en el HTML ===
    const exito = document.createElement('p');
    exito.textContent = '✅ El mensaje se ha enviado correctamente';
    // Clases Tailwind: fondo verde, texto blanco, centrado
    exito.classList.add('bg-green-500', 'text-white', 'p-2', 'text-center', 'rounded', 'mt-4');
    formulario.appendChild(exito); // Lo añadimos debajo del formulario

    // Después de 3 segundos, eliminamos el mensaje y reseteamos el formulario
    setTimeout(() => {
      exito.remove();
      resetFormulario();
    }, 3000);
  }, 2500);
}

// ===============================
// 9️⃣ FUNCIÓN RESET
// ===============================
// Se ejecuta al hacer clic en el botón "Reset"
function resetFormulario() {
  formulario.reset(); // Limpia los campos en el HTML
  // Reinicia los valores del objeto emailObj
  emailObj.email = '';
  emailObj.asunto = '';
  emailObj.mensaje = '';
  comprobarCampos(); // Desactiva nuevamente el botón Enviar
}

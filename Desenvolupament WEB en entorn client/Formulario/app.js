const formulario = document.querySelector('#formulario');
const inputEmail = document.querySelector('#email');
const inputAsunto = document.querySelector('#asunto');
const inputMensaje = document.querySelector('#mensaje');
const btnSubmit = formulario.querySelector('button[type="submit"]');
const btnReset = formulario.querySelector('button[type="reset"]');
const spinnerDiv = document.querySelector('#spinner');

const emailObj = {
  email: '',
  asunto: '',
  mensaje: ''
};

eventListeners();

function eventListeners() {
  inputEmail.addEventListener('input', validar);
  inputAsunto.addEventListener('input', validar);
  inputMensaje.addEventListener('input', validar);

  formulario.addEventListener('submit', enviarEmail);
  btnReset.addEventListener('click', resetFormulario);
}

function validar(e) {
  const valor = e.target.value.trim();
  const campo = e.target.id;

  if (valor === '') {
    mostrarError(`El campo ${campo.toUpperCase()} es obligatorio`, e.target);
    emailObj[campo] = '';
    comprobarCampos();
    return;
  }

  if (campo === 'email' && !validarEmail(valor)) {
    mostrarError('El EMAIL no es válido', e.target);
    emailObj[campo] = '';
    comprobarCampos();
    return;
  }

  limpiarError(e.target);
  emailObj[campo] = valor;
  comprobarCampos();
}

function mostrarError(mensaje, referencia) {
  limpiarError(referencia);
  const error = document.createElement('p');
  error.textContent = mensaje;
  error.classList.add('bg-red-600', 'text-white', 'p-2', 'text-center', 'rounded', 'text-sm');
  referencia.parentElement.appendChild(error);
}

function limpiarError(referencia) {
  const alerta = referencia.parentElement.querySelector('.bg-red-600');
  if (alerta) alerta.remove();
}

function comprobarCampos() {
  if (Object.values(emailObj).includes('')) {
    btnSubmit.disabled = true;
    btnSubmit.classList.add('opacity-50');
  } else {
    btnSubmit.disabled = false;
    btnSubmit.classList.remove('opacity-50');
  }
}

function validarEmail(email) {
  const regex = /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;
  return regex.test(email);
}

function enviarEmail(e) {
  e.preventDefault();

  spinnerDiv.classList.remove('hidden');
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

  setTimeout(() => {
    spinnerDiv.innerHTML = '';
    spinnerDiv.classList.add('hidden');

    const exito = document.createElement('p');
    exito.textContent = 'El mensaje se ha enviado correctamente';
    exito.classList.add('bg-green-500', 'text-white', 'p-2', 'text-center', 'rounded');
    formulario.appendChild(exito);

    setTimeout(() => {
      exito.remove();
      resetFormulario();
    }, 3000);
  }, 2500);
}

function resetFormulario() {
  formulario.reset();
  emailObj.email = '';
  emailObj.asunto = '';
  emailObj.mensaje = '';
  comprobarCampos();
}

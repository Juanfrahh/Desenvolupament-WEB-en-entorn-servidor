// ======== VARIABLES ========
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
        comprobarEmailObj();
        return;
    }

    if (campo === 'email' && !validarEmail(valor)) {
        mostrarError('El EMAIL no es válido', e.target);
        emailObj[campo] = '';
        comprobarEmailObj();
        return;
    }

    limpiarError(e.target);
    emailObj[campo] = valor.toLowerCase();
    comprobarEmailObj();
}

function mostrarError(mensaje, referencia) {
    limpiarError(referencia);
    const error = document.createElement('P');
    error.textContent = mensaje;
    error.classList.add('bg-red-600', 'text-white', 'p-2', 'text-center', 'rounded');
    referencia.parentElement.appendChild(error);
}

function limpiarError(referencia) {
    const alerta = referencia.parentElement.querySelector('.bg-red-600');
    if (alerta) alerta.remove();
}

function comprobarEmailObj() {
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

        const alertaExito = document.createElement('P');
        alertaExito.textContent = 'El mensaje se ha enviado correctamente';
        alertaExito.classList.add('bg-green-600', 'text-white', 'p-2', 'text-center', 'rounded');
        formulario.appendChild(alertaExito);

        setTimeout(() => {
            alertaExito.remove();
            resetFormulario();
        }, 3000);
    }, 2500);
}

function resetFormulario() {
    formulario.reset();
    emailObj.email = '';
    emailObj.asunto = '';
    emailObj.mensaje = '';
    comprobarEmailObj();
}

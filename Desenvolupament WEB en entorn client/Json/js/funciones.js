// js/funciones.js

// Mostrar un mensaje de alerta dentro del formulario
export function mostrarAlerta(mensaje) {
  const alerta = document.querySelector('.bg-red-100');
  if (alerta) return; // evita duplicados

  const alertaNueva = document.createElement('p');
  alertaNueva.classList.add(
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
  alertaNueva.textContent = mensaje;

  const formulario = document.querySelector('#formulario');
  formulario.appendChild(alertaNueva);

  setTimeout(() => alertaNueva.remove(), 3000);
}

// Validar que todos los campos del objeto tengan valor
export function validar(objeto) {
  return !Object.values(objeto).every(input => input !== '');
}

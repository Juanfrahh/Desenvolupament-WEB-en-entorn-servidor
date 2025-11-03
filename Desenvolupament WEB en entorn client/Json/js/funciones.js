// js/funciones.js
export function mostrarAlerta(mensaje) {
  const alerta = document.querySelector('.bg-red-100');
  if (alerta) return;

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

  document.querySelector('#formulario').appendChild(alertaNueva);

  setTimeout(() => alertaNueva.remove(), 3000);
}

export function validar(objeto) {
  // devuelve true si hay algún campo vacío
  return !Object.values(objeto).every(valor => valor !== '');
}

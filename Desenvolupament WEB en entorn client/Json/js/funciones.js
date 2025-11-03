// funciones.js
export function mostrarAlerta(mensaje) {
  const alerta = document.createElement('p');
  alerta.textContent = mensaje;
  alerta.classList.add('bg-red-100', 'border-red-400', 'text-red-700', 'p-3', 'rounded', 'mt-4', 'text-center');
  document.querySelector('#formulario').appendChild(alerta);

  setTimeout(() => alerta.remove(), 3000);
}

export function validar(objeto) {
  return !Object.values(objeto).every(input => input !== '');
}

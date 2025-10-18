// =====================
// VARIABLES
// =====================
const formulario = document.querySelector('#formulario');
const selectAnio = document.querySelector('#anio');
const mensajeErrorDiv = document.querySelector('#mensajeError');

// =====================
// CLASE POLIZA
// =====================
class Poliza {
  constructor(tipo, anio, cobertura) {
    this.tipo = tipo;
    this.anio = anio;
    this.cobertura = cobertura;
    this.importe = 0;
  }

  calcularSeguro() {
    const base = 300;
    let cantidad = base;

    // Gama del vehículo
    switch (this.tipo) {
      case 'baja':
        cantidad += base * 0.05;
        break;
      case 'media':
        cantidad += base * 0.15;
        break;
      case 'alta':
        cantidad += base * 0.3;
        break;
    }

    // Antigüedad del vehículo
    const diferencia = new Date().getFullYear() - this.anio;
    cantidad += cantidad * (diferencia * 0.03);

    // Tipo de cobertura
    if (this.cobertura === 'basico') {
      cantidad *= 1.3;
    } else if (this.cobertura === 'completo') {
      cantidad *= 1.5;
    }

    this.importe = Math.round(cantidad);
    return this.importe;
  }

  mostrarInfoHTML() {
    document.querySelector('#resumen-tipo').textContent = `Tipo de vehículo: ${this.tipo.toUpperCase()}`;
    document.querySelector('#resumen-anio').textContent = `Año: ${this.anio}`;
    document.querySelector('#resumen-cobertura').textContent = `Cobertura: ${this.cobertura.toUpperCase()}`;
    document.querySelector('#resumen-precio').textContent = `Total: ${this.importe} €`;

    const modal = new bootstrap.Modal(document.getElementById('modal'));
    modal.show();
  }
}

// =====================
// EVENTOS
// =====================
document.addEventListener('DOMContentLoaded', () => {
  llenarSelectAnios();
});

formulario.addEventListener('submit', validarFormulario);

// =====================
// FUNCIONES
// =====================
function llenarSelectAnios() {
  const max = new Date().getFullYear();
  const min = max - 20;

  for (let i = max; i >= min; i--) {
    const option = document.createElement('option');
    option.value = i;
    option.textContent = i;
    selectAnio.appendChild(option);
  }
}

function validarFormulario(e) {
  e.preventDefault();

  const tipo = document.querySelector('#tipo').value;
  const anio = document.querySelector('#anio').value;
  const cobertura = document.querySelector('input[name="cobertura"]:checked')?.value;

  // Validación: si falta un campo
  if (tipo === '' || anio === '' || !cobertura) {
    mostrarError('Falta un campo por rellenar');
    return;
  }

  // Si está todo correcto
  limpiarError();
  const poliza = new Poliza(tipo, anio, cobertura);
  poliza.calcularSeguro();
  poliza.mostrarInfoHTML();
}

function mostrarError(mensaje) {
  limpiarError(); // evitar mensajes repetidos

  const error = document.createElement('div');
  error.textContent = mensaje;
  error.classList.add(
    'text-red-100',
    'p-4',
    'text-center',
    'font-semibold',
  );

  mensajeErrorDiv.appendChild(error);
}

function limpiarError() {
  mensajeErrorDiv.innerHTML = '';
}

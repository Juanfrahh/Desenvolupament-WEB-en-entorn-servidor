const formulario = document.querySelector('#formulario');
const selectAnio = document.querySelector('#anio');
const mensajeErrorDiv = document.querySelector('#mensajeError');

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

    const diferencia = new Date().getFullYear() - this.anio;
    cantidad += cantidad * (diferencia * 0.03);

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
//Motrar años
document.addEventListener('DOMContentLoaded', () => {
  llenarSelectAnios();
  mostrarError('Todos los campos son obligatorios');
});

// formulario.addEventListener('submit', validarFormulario);

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

  if (tipo === '' || anio === '' || !cobertura) {
    mostrarError('Todos los campos son obligatorios');
    return;
  }

  // Si está todo correcto
  limpiarError();
  const poliza = new Poliza(tipo, anio, cobertura);
  poliza.calcularSeguro();
  poliza.mostrarInfoHTML();
}

function limpiarError() {
  mensajeErrorDiv.innerHTML = '';
}

// =====================
// VARIABLES
// =====================
const formulario = document.querySelector('#cotizar-seguro');
const selectGama = document.querySelector('#gama');
const selectYear = document.querySelector('#year');
const radiosTipo = document.querySelectorAll('input[name="tipo"]');
const divResultado = document.querySelector('#resultado');

// =====================
// CLASE POLIZA
// =====================
class Poliza {
  constructor(gama, year, tipo) {
    this.gama = gama;
    this.year = year;
    this.tipo = tipo;
    this.importe = 0;
  }

  calcularSeguro() {
    let base = 300;
    let cantidad = base;

    // Incremento por gama
    switch (this.gama) {
      case '1': // Baja
        cantidad += base * 0.05;
        break;
      case '2': // Media
        cantidad += base * 0.15;
        break;
      case '3': // Alta
        cantidad += base * 0.3;
        break;
    }

    // Incremento por antigüedad
    const diferencia = new Date().getFullYear() - this.year;
    cantidad += cantidad * (diferencia * 0.03);

    // Incremento por tipo de cobertura
    if (this.tipo === 'Básico') {
      cantidad *= 1.3;
    } else if (this.tipo === 'Completo') {
      cantidad *= 1.5;
    }

    this.importe = Math.round(cantidad);
    return this.importe;
  }

  mostrarInfoHTML() {
    const modalTitle = document.querySelector('.modal-title');
    const modalBody = document.querySelector('.modal-body');
    const modalFooter = document.querySelector('.modal-footer');

    modalTitle.textContent = 'Resumen de la Póliza';
    modalBody.innerHTML = `
      <p><strong>Gama del vehículo:</strong> ${this.gama == 1 ? 'Baja' : this.gama == 2 ? 'Media' : 'Alta'}</p>
      <p><strong>Año:</strong> ${this.year}</p>
      <p><strong>Tipo de cobertura:</strong> ${this.tipo}</p>
      <p class="text-xl mt-3"><strong>Total:</strong> ${this.importe} €</p>
    `;

    modalFooter.innerHTML = `
      <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
    `;

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

// Borrar error al modificar campos
selectGama.addEventListener('change', limpiarError);
selectYear.addEventListener('change', limpiarError);
radiosTipo.forEach(radio => radio.addEventListener('change', limpiarError));

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
    selectYear.appendChild(option);
  }
}

function validarFormulario(e) {
  e.preventDefault();

  const gama = selectGama.value;
  const year = selectYear.value;
  const tipo = document.querySelector('input[name="tipo"]:checked')?.value;

  if (gama === '' || year === '' || !tipo) {
    mostrarError('⚠️ Rellena los campos que faltan antes de calcular');
    return;
  }

  limpiarError();

  const poliza = new Poliza(gama, year, tipo);
  poliza.calcularSeguro();
  poliza.mostrarInfoHTML();
}

function mostrarError(mensaje) {
  limpiarError();

  const error = document.createElement('div');
  error.textContent = mensaje;

  // 🔥 Estilo visible en todos los navegadores (sin depender de Tailwind)
  error.style.backgroundColor = '#f8d7da'; // fondo rojo claro
  error.style.color = '#842029'; // texto rojo oscuro
  error.style.border = '1px solid #f5c2c7';
  error.style.padding = '12px';
  error.style.borderRadius = '6px';
  error.style.textAlign = 'center';
  error.style.fontWeight = '600';
  error.style.marginTop = '15px';
  error.style.maxWidth = '500px';
  error.style.marginLeft = 'auto';
  error.style.marginRight = 'auto';
  error.style.boxShadow = '0 2px 6px rgba(0,0,0,0.1)';

  divResultado.appendChild(error);
}

function limpiarError() {
  divResultado.innerHTML = '';
}

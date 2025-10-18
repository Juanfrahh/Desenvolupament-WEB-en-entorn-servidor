const formulario = document.querySelector('#cotizar-seguro');
const selectGama = document.querySelector('#gama');
const selectYear = document.querySelector('#year');
const resultado = document.querySelector('#resultado');

class Poliza {
  constructor(gama, year, tipo) {
    this._gama = gama;
    this._year = year;
    this._tipo = tipo;
    this._importe = 300; // base mínima
  }

  get gama() {
    return this._gama;
  }
  get year() {
    return this._year;
  }
  get tipo() {
    return this._tipo;
  }
  get importe() {
    return this._importe;
  }

  // Calcular seguro según el enunciado
  calcularSeguro() {
    let total = this._importe;

    switch (this._gama) {
      case '1':
        total += total * 0.05;
        break;
      case '2':
        total += total * 0.15;
        break;
      case '3':
        total += total * 0.30;
        break;
    }

    // Incremento según antigüedad del coche
    const yearActual = new Date().getFullYear();
    const antiguedad = yearActual - this._year;
    total += total * (antiguedad * 0.03);

    // Incremento según tipo de cobertura
    if (this._tipo === 'Básico') {
      total += total * 0.30;
    } else {
      total += total * 0.50;
    }

    // Redondear
    this._importe = Math.round(total);
  }

  // Mostrar información en el Modal
  mostrarInfoHTML() {
    modalTitle.textContent = 'RESUMEN DE PÓLIZA';
    modalTitle.classList.add('header', 'col');

    modalBody.innerHTML = `
      <p class="font-bold">Tipo de gama: ${this.obtenerGamaTexto()}</p>
      <p class="font-bold">Año del vehículo: ${this._year}</p>
      <p class="font-bold">Cobertura: ${this._tipo}</p>
      <p class="font-bold">Importe total: ${this._importe} €</p>
    `;

    modalFooter.innerHTML = '';
    const btnCerrar = document.createElement('button');
    btnCerrar.textContent = 'Cerrar';
    btnCerrar.classList.add('btn', 'btn-primary', 'btn-raised', 'col');
    btnCerrar.onclick = () => modal.hide();
    modalFooter.appendChild(btnCerrar);

    modal.show();
  }

  // Devuelve el texto de la gama
  obtenerGamaTexto() {
    switch (this._gama) {
      case '1':
        return 'Gama Baja';
      case '2':
        return 'Gama Media';
      case '3':
        return 'Gama Alta';
      default:
        return '';
    }
  }
}

// =========================
// FUNCIONES
// =========================
document.addEventListener('DOMContentLoaded', () => {
  llenarSelectAnios();
// Cargar los años dinámicamente
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

// Evento de envío del formulario
formulario.addEventListener('submit', e => {
  e.preventDefault();

  const gama = selectGama.value;
  const year = selectYear.value;
  const tipo = document.querySelector('input[name="tipo"]:checked')?.value;

  // Validar campos
  if (gama === '' || year === '' || tipo === '') {
    mostrarError('Todos los campos son obligatorios');
    return;
  }

  // Calcular póliza
  const poliza = new Poliza(gama, year, tipo);
  poliza.calcularSeguro();
  poliza.mostrarInfoHTML();
});

// Mostrar mensaje de error controlado
function mostrarError(mensaje) {
  limpiarError();
  const divError = document.createElement('div');
  divError.classList.add('error', 'mt-10', 'text-center', 'p-3');
  divError.textContent = mensaje;

  resultado.appendChild(divError);

  setTimeout(() => {
    divError.remove();
  }, 3000);
}

// Evitar mensajes duplicados
function limpiarError() {
  const alerta = document.querySelector('.error');
  if (alerta) alerta.remove();
}
